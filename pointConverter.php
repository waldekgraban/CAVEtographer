<?php
/*
 *
 * Copyright (c) 2019 Waldemar Graban
 *
 */

class PointsCollection implements IteratorAggregate
{
    protected $points;

    public function __construct(array $points)
    {
        $this->points = $points;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->points);
    }

    public function relativeHeightDiff(Point $lastPoint)
    {
        return $this->calculateTotal($lastPoint, function ($point) {
            return $point->projectedHeight();
        });
    }

    // x axis deviation from north
    public function latitudeDeviation(Point $lastPoint)
    {
        return $this->calculateTotal($lastPoint, function ($point) {
            return $point->latitudeDiff();
        });
    }

    // y axis deviation from north
    public function longitudeDeviation(Point $lastPoint)
    {
        return $this->calculateTotal($lastPoint, function ($point) {
            return $point->longitudeDiff();
        });
    }

    protected function calculateTotal(Point $lastPoint, callable $callback)
    {
        $total = 0;

        foreach ($this->points as $point) {
            $total += $callback($point);

            if ($point === $lastPoint) {
                break;
            }
        }

        return $total;
    }

    public function toCsv()
    {
        $output = fopen('php://memory', 'r+');

        fputcsv($output, [
            'Od', 'Do', 'Dlugosc', 'Azymut', 'Upad', 'Zrzutowana dlugosc', 'Zrzutowana wysokosc', 'WE', 'NS', 'Roznica wysokosci', 'Os X', 'Os Y',
        ]);

        foreach ($this->points as $key => $point) {
            fputcsv($output, [
                $key,
                $key + 1,
                $point->length(),
                $point->azimuth(),
                $point->inclination(),
                $point->projectedLength(),
                $point->projectedHeight(),
                $point->latitudeDiff(),
                $point->longitudeDiff(),
                $this->relativeHeightDiff($point),
                $this->latitudeDeviation($point),
                $this->longitudeDeviation($point),
            ]);
        }

        rewind($output);

        return stream_get_contents($output);
    }
}

class Point
{
    protected $length;

    protected $azimuth;

    protected $inclination;

    public function __construct($length, $azimuth, $inclination)
    {
        $this->length   = $length;
        $this->azimuth  = $azimuth;
        $this->inclination = $inclination;
    }

    public function length()
    {
        return $this->length;
    }

    public function azimuth()
    {
        return $this->azimuth;
    }

    public function inclination()
    {
        return $this->inclination;
    }

    public function projectedLength()
    {
        return round($this->length() * cos(deg2rad($this->inclination())), 2);
    }

    public function projectedHeight()
    {
        return round($this->length() * sin(deg2rad($this->inclination())), 2);
    }

    public function latitudeDiff()
    {
        return round($this->projectedLength() * sin(deg2rad($this->azimuth())), 2);
    }

    public function longitudeDiff()
    {
        return round($this->projectedLength() * cos(deg2rad($this->azimuth())), 2);
    }

    public function heightDiff(Point $point)
    {
        return $point->projectedHeight() + $this->projectedHeight();
    }
}

$points = new PointsCollection([
    0 => new Point(6.5, 293, -36),
    1 => new Point(5.4, 234, -41),
    2 => new Point(2.5, 237, -38),
    3 => new Point(7.9, 246, -33),
]);

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=pomiary.csv");
header("Pragma: no-cache");
header("Expires: 0");

echo $points->toCsv();

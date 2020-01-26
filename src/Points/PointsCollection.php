<?php
/*
 *
 * Created by Waldemar Graban & Krzysztof Grabania 2019
 *
 */

namespace Waldekgraban\Converter\Points;

class PointsCollection implements \IteratorAggregate
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
            'From', 'To', 'Length', 'Azimuth', 'Inclination', 'Dumped Length', 'Dumped Height', 'WE', 'NS', 'Height Difference', 'X-axis', 'Y-axis',
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

    public function showResult()
    {
        foreach ($this->points as $key => $point) {
            echo "length = " . $point->length() . "<br>";
            echo "azimuth = " . $point->azimuth() . "<br>";
            echo "inclination = " . $point->inclination() . "<br>";
            echo "projectedLength = " . $point->projectedLength() . "<br>";
            echo "projectedHeight = " . $point->projectedHeight() . "<br>";
            echo "latitudeDiff = " . $point->latitudeDiff() . "<br>";
            echo "longitudeDiff = " . $point->longitudeDiff() . "<br>";
            echo "relativeHeightDiff = " . $this->relativeHeightDiff($point) . "<br>";
            echo "X-axis = " . $this->latitudeDeviation($point) . "<br>";
            echo "Y-axis = " . $this->longitudeDeviation($point) . "<br>";
            echo "<br><br>";
        }
    }
}

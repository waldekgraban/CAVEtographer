<?php
/*
 *
 * Created by Waldemar Graban & Krzysztof Grabania 2019
 *
 */

namespace Waldekgraban\Converter\Points;

class Point
{
    protected $length;

    protected $azimuth;

    protected $inclination;

    public function __construct($length, $azimuth, $inclination)
    {
        $this->length      = $length;
        $this->azimuth     = $azimuth;
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

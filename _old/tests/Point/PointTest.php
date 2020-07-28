<?php

namespace Waldekgraban\Converter\Tests\Unit;

use Waldekgraban\Converter\Points\Point;
use Waldekgraban\Converter\Tests\TestCase;

class PointTest extends TestCase
{
    protected $point;

    protected function setUp(): void
    {
        $length      = 6;
        $azimuth     = 180;
        $inclination = -3;

        $this->point = new Point($length, $azimuth, $inclination);
    }

    public function testCanInitializeByConstructor()
    {
        $this->assertInstanceOf(Point::class, $this->point);
    }

    public function testPointLengthIsNumber()
    {
        $this->assertIsInt($this->point->length());
    }

    public function testPointAzimuthIsNumber()
    {
        $this->assertIsInt($this->point->azimuth());
    }

    public function testPointInclinationIsNumber()
    {
        $this->assertIsInt($this->point->inclination());
    }

    public function testPointProjectedLengthIsNumber()
    {
        $this->assertIsNumeric($this->point->projectedLength());
    }

    public function testPointProjectedHeightIsNumber()
    {
        $this->assertIsNumeric($this->point->projectedHeight());
    }

    public function testPointLatitudeDiffIsNumber()
    {
        $this->assertIsNumeric($this->point->latitudeDiff());
    }

    public function testPointLongitudeDiffIsNumber()
    {
        $this->assertIsNumeric($this->point->longitudeDiff());
    }

    public function testPointHeightDiffIsNumber()
    {
        $this->assertIsNumeric($this->point->heightDiff($this->point));
    }

    protected function tearDown(): void
    {
        unset($this->point);
    }
}

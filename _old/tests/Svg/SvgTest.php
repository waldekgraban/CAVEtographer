<?php

namespace Waldekgraban\Converter\Tests\Unit;

use PHPSurvex\PHPSurvex\Parser\Parser;
use Waldekgraban\Converter\Points\Point;
use Waldekgraban\Converter\Points\PointsCollection;
use Waldekgraban\Converter\Svg\Svg;
use Waldekgraban\Converter\Tests\TestCase;

class SvgTest extends TestCase
{
    protected $svg;

    protected function setUp(): void
    {

        $filename = __DIR__ . '/Examples/black_hawk_down.svx';
        $content  = file_get_contents($filename);
        $parser   = Parser::make($content);

        $surveys = $parser->parse();

        $survey = $surveys->first();
        $data   = $survey->getData()->first();

        foreach ($data->getMeasurements() as $measurement) {
            $points[$measurement->getValue('from')] = new Point(
                $measurement->getValue('compass'),
                $measurement->getValue('tape'),
                $measurement->getValue('clino')
            );
        }

        $points = new PointsCollection($points);

        $coordinates = $points->getCoordinateSystemData();
        $style       = ['stroke-width: 2;', 'stroke: black;', 'fill: none;'];
        $this->svg   = new Svg($coordinates, $style);
    }

    public function testCanInitializeByConstructor()
    {
        $this->assertInstanceOf(Svg::class, $this->svg);
    }

    public function testSvgCoordinatesAreAnArray()
    {
        $this->assertIsArray($this->svg->getCoordinates());
    }

    public function testSvgCoordinatesArrayHasKeyX()
    {
        $this->assertArrayHasKey("x", $this->svg->getCoordinates()[0]);
    }

    public function testSvgCoordinatesArrayHasKeyY()
    {
        $this->assertArrayHasKey("y", $this->svg->getCoordinates()[0]);
    }

    public function testSvgStyleIsString()
    {
        $this->assertIsString($this->svg->getStyle());
    }

    public function testSvgGeneratedMeasuringLinesAreString()
    {
        $this->assertIsString($this->svg->generateMeasuringLine());
    }
}

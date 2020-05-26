<?php

namespace Waldekgraban\Converter;

require_once "../vendor/autoload.php";

use PHPSurvex\PHPSurvex\Parser\Parser;
use Waldekgraban\Converter\Points\Point;
use Waldekgraban\Converter\Points\PointsCollection;
use Waldekgraban\Converter\Svg\Svg;

// header("Content-type: text/csv");
// header("Content-Disposition: attachment; filename=pomiary.csv");
// header("Pragma: no-cache");
// header("Expires: 0");
// echo $points->toCsv();

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

// $coordinates = $points->getCoordinateSystemData();
// $style       = ['stroke-width: 2;', 'stroke: black;', 'fill: none;'];
// $caveMap     = new Svg($coordinates, $style);
// $caveMap->show();
// // dd($caveMap->generateMeasuringLine());

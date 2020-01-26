<?php

namespace Waldekgraban\Converter;

require_once "../vendor/autoload.php";

use Waldekgraban\Converter\Points\Point;
use Waldekgraban\Converter\Points\PointsCollection;

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

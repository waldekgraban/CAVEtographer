<?php

namespace Waldekgraban\Converter\Svg;

class Svg
{
    protected $coordinates;
    protected $style;

    public function __construct(array $coordinates, array $style)
    {
        $this->coordinates = $coordinates;
        $this->style       = $style;
    }

    public function getCoordinates()
    {
        return $this->coordinates;
    }

    public function getStyle()
    {
        return implode(' ', $this->style);
    }

    public function generateMeasuringLine()
    {
        $line = '';

        foreach ($this->coordinates as $key => $axis) {
            $line .= ' l' . $axis['x'] . ',' . $axis['y'];
        }

        return $line;
    }

    public function create()
    {
        //return '<path d="M100,100' . $this->generateMeasuringLine() . '" style=" ' . $this->getStyle() . ' " />';
    }

    public function show()
    {
        // echo '<svg xmlns="http://www.w3.org/2000/svg" version="1.1">';
        // // echo $this->create();
        // echo '<path d="M66.072 -53.080 L61.370 -55.448L57.930 -53.263L56.210 -52.302L50.000 -50.000"/>';
        // // echo '<path d="M20,20 l26.83,235.52 l43.45,411.34 l51.6,597.92 l79.96,802.27 " style="stroke-width: 2; stroke: black; fill: none; " />';
        // echo '</svg>';

//         echo '<svg version="1.1" baseProfile="full"';
//         echo 'xmlns="http://www.w3.org/2000/svg"';
//         echo 'xmlns:xlink="http://www.w3.org/1999/xlink"';
//         echo 'xmlns:ev="http://www.w3.org/2001/xml-events"';
//         echo 'width="126.072mm" height="115.448mm"';
//         echo 'viewBox="0 0 126.072 115.448">';
//         echo '<title>dupce</title>';
//         echo '<g transform="translate(5.000 110.448)">';
//         echo '<g id="Legs" stroke="black" fill="none" stroke-width="0.4px">';
//         echo '<path d="M66.072 -53.080 l26.83,235.52 l43.45,411.34 l51.6,597.92 l79.96,802.27 " />';
//         echo '</g>';
//         echo '</g>';
//         echo '</svg>';
    }
}
// <path d="M0,0  l15.94,80.31 l55.11,219.13 l154.12,387.6 l220.22,525.44 l285.92,670.54 l317.21,845.58 l400.85,961.84 l494.4,1132.13 l593.96,1290.37" style="stroke-width: 2; stroke: black; fill: none;"></path>

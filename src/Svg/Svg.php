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
            echo $line .= $axis['x'] . ',' . $axis['y'] . '<br>';
        }

        return $line;
    }

    public function create()
    {
        //return '<path d="M100,100' . $this->generateMeasuringLine() . '" style=" ' . $this->getStyle() . ' " />';
    }

    public function showTest()
    {
        echo ' <?xml version="1.0" encoding="UTF-8"?>';
        echo ' <svg version="1.1" baseProfile="full"';
        echo ' xmlns="http://www.w3.org/2000/svg"';
        echo ' xmlns:xlink="http://www.w3.org/1999/xlink"';
        echo ' xmlns:ev="http://www.w3.org/2001/xml-events"';
        echo ' width="255.786mm" height="335.327mm"';
        echo ' viewBox="0 0 255.786 335.327">';
        echo ' <title>black_hawk_down</title>';
        echo ' <g transform="translate(5.000 330.327)">';
        echo ' <g id="Legs" stroke="black" fill="none" stroke-width="0.4px">';
        echo ' <path d="M56.491 -259.921L66.228 -265.339"/>';
        echo ' <path d="M66.228 -265.339L78.708 -256.293"/>';
        echo ' <path d="M78.708 -256.293L81.659 -226.084"/>';
        echo ' <path d="M81.659 -226.084L57.427 -244.244"/>';
        echo ' <path d="M81.659 -226.084L100.856 -209.134"/>';
        echo ' <path d="M100.856 -209.134L128.107 -231.555"/>';
        echo ' <path d="M100.856 -209.134L113.971 -189.978"/>';
        echo ' <path d="M113.971 -189.978L118.026 -180.709"/>';
        echo ' <path d="M118.026 -180.709L105.553 -163.164"/>';
        echo ' <path d="M118.026 -180.709L148.452 -161.964"/>';
        echo ' <path d="M148.452 -161.964L150.984 -133.588"/>';
        echo ' <path d="M150.984 -133.588L157.933 -102.516"/>';
        echo ' </g>';
        echo ' </g>';
        echo ' </svg>';
    }

    public function show()
    {
        // $xy[] = ['x' => 1, 'y' => 2];
        // $xy[] = ['x' => 7, 'y' => 12];
        // $xy[] = ['x' => 2, 'y' => 8];
        // $xy[] = ['x' => 8, 'y' => 1];

        // die(dump($this->coordinates));

        echo ' <?xml version="1.0" encoding="UTF-8"?>';
        echo ' <svg version="1.1" baseProfile="full"';
        echo ' xmlns="http://www.w3.org/2000/svg"';
        echo ' xmlns:xlink="http://www.w3.org/1999/xlink"';
        echo ' xmlns:ev="http://www.w3.org/2001/xml-events"';
        echo ' width="255.786mm" height="335.327mm"';
        echo ' viewBox="0 0 1255.786 1335.327">';
        echo ' <title>black_hawk_down</title>';

        echo ' <g id="Legs" stroke="black" fill="none" stroke-width="3px">';
        while ($current = current($this->coordinates)) {
            if ($next = next($this->coordinates)) {
                echo "<path d=\"M{$current['x']} {$current['y']} L{$next['x']} {$next['y']}\"/>\n";
            }
        }
        echo ' </g>';

        echo ' </svg>';

        echo ' <?xml version="1.0" encoding="UTF-8"?>';
        echo ' <svg version="1.1" baseProfile="full"';
        echo ' xmlns="http://www.w3.org/2000/svg"';
        echo ' xmlns:xlink="http://www.w3.org/1999/xlink"';
        echo ' xmlns:ev="http://www.w3.org/2001/xml-events"';
        echo ' width="255.786mm" height="335.327mm"';
        echo ' viewBox="0 0 255.786 335.327">';
        echo ' <title>black_hawk_down</title>';
        echo ' <g transform="translate(5.000 330.327)">';
        echo ' <g id="Legs" stroke="black" fill="none" stroke-width="0.4px">';
        echo ' <path d="M56.491 -259.921L66.228 -265.339"/>';
        echo ' <path d="M66.228 -265.339L78.708 -256.293"/>';
        echo ' <path d="M78.708 -256.293L81.659 -226.084"/>';
        echo ' <path d="M81.659 -226.084L57.427 -244.244"/>';
        echo ' <path d="M81.659 -226.084L100.856 -209.134"/>';
        echo ' <path d="M100.856 -209.134L128.107 -231.555"/>';
        echo ' <path d="M100.856 -209.134L113.971 -189.978"/>';
        echo ' <path d="M113.971 -189.978L118.026 -180.709"/>';
        echo ' <path d="M118.026 -180.709L105.553 -163.164"/>';
        echo ' <path d="M118.026 -180.709L148.452 -161.964"/>';
        echo ' <path d="M148.452 -161.964L150.984 -133.588"/>';
        echo ' <path d="M150.984 -133.588L157.933 -102.516"/>';
        echo ' </g>';
        echo ' </g>';
        echo ' </svg>';
    }
}

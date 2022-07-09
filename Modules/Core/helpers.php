<?php

use BladeUI\Icons\Svg;

if (! function_exists('purifySvg')) {
    function purifySvg(Svg $svg): string
    {
        return preg_replace('#<title>.*</title>#', '', $svg->toHtml());
    }
}

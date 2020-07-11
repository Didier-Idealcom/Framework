<?php

use BladeSvg\SvgFactory;

if (! function_exists('svg')) {
    function svg($icon, $class = '', $attrs = [])
    {
        return preg_replace('#<title>.*</title>#', '', app(SvgFactory::class)->svg($icon, $class, $attrs)->renderInline());
    }
}

<?php

require './Primitives/Base.php';
require './Primitives/Circle.php';
require './Primitives/Rectangle.php';
require './Primitives/Triangle.php';

$data = json_decode(file_get_contents('./figures.json'), true);
$figures = [];

foreach ($data as $fig)
{
    $class_name = ucfirst($fig['type']);
    $figures[] = new $class_name($fig);
}

usort($figures,  function($a, $b)
{
    return ($a->area < $b->area) ? 1 : (($a->area > $b->area) ? -1 : 0);
});

foreach ($figures as $fig)
{
    echo $fig;
}


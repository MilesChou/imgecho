<?php

require_once __DIR__ . '/../vendor/autoload.php';

$uri = 'https://chart.apis.google.com/chart?cht=lc&chs=450x200&chd=t:70,72,67,68,65,59,64,70,73,75,78,80&chxt=x,y&chxl=0:|Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec&chg=10,20';

$resolver = static function () use ($uri) {
    return file_get_contents($uri);
};

$echoer = new MilesChou\ImgEcho\ImgEcho();
$echoer->withName('basic');

$echoer->withImage($resolver);
$echoer->send();

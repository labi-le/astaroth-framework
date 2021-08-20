<?php

use Astaroth\Foundation\Application;

$app = new Application();
$app->run(__DIR__);

//if prod set
// $app->run(type: Application::PRODUCTION);

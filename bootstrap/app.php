<?php

declare(strict_types=1);

use Astaroth\Foundation\Application;

$app = new Application(dirname(__DIR__));
$app->run();

//if prod set
// $$app = new Application(type: Application::PRODUCTION);

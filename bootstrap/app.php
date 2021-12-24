<?php

declare(strict_types=1);

use Astaroth\Enums\Configuration\ApplicationWorkMode;
use Astaroth\Foundation\Application;

//1 param set dotenv file
$app = new Application(getcwd(), ApplicationWorkMode::DEVELOPMENT);
$app->run();

//if prod set
// $$app = new Application(type: ApplicationWorkMode::::PRODUCTION);

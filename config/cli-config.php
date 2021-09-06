<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;

require_once "vendor/autoload.php";

//needed to generate models
//you have to change it to fit your needs
$config = Setup::createAnnotationMetadataConfiguration(["./App/Entity"], true);

$connection =
    [
        "driver" => "",
        "host" => "",
        "dbname" => "",
        "user" => "",
        "password" => ""
    ];

$entityManager = EntityManager::create($connection, $config);

return ConsoleRunner::createHelperSet($entityManager);
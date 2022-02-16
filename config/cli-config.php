<?php

declare(strict_types=1);

/**
 * needed to generate models
 * you have to change it to fit your needs
 */

use Astaroth\Auth\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Setup;

require_once "vendor/autoload.php";

//Configuration::set(type: \Astaroth\Foundation\Application::PRODUCTION);
$configuration = Configuration::set(dirname(__DIR__));

//$config = Setup::createAnnotationMetadataConfiguration([getenv("ENTITY_PATH")]);
$doctrineConfig = Setup::createAttributeMetadataConfiguration([$configuration->getEntityPath()], true);

//$connection =
//    [
//        "driver" => getenv("DATABASE_DRIVER"),
//        "host" => getenv("DATABASE_HOST"),
//        "dbname" => getenv("DATABASE_NAME"),
//        "user" => getenv("DATABASE_USER"),
//        "password" => getenv("DATABASE_PASSWORD")
//    ];

$connection =
    [
        "driver" => $configuration->getDatabaseDriver(),
        "host" => $configuration->getDatabaseHost(),
        "dbname" => $configuration->getDatabaseName(),
        "user" => $configuration->getDatabaseUser(),
        "password" => $configuration->getDatabasePassword()
    ];

$entityManager = EntityManager::create($connection, $doctrineConfig);

return ConsoleRunner::createHelperSet($entityManager);
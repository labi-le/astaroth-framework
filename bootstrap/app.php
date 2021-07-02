<?php

use Astaroth\Auth\Configuration;
use Astaroth\Handler\LazyHandler;
use Astaroth\Route\Route;
use Symfony\Component\DependencyInjection\ContainerBuilder;

$container = new ContainerBuilder();
$configuration = (new Configuration(dirname(__DIR__)))
    ->get();

//print_r($configuration);

array_walk($configuration, static fn($value, $key) => $container->setParameter($key, $value));

$facades = require "containers.php";

new \Astaroth\Support\Facades\Facade(
    ...array_map(static function ($facade) use ($container) {
        return (new $facade($container->getParameter("API_VERSION")))
            ->setDefaultToken($container->getParameter("ACCESS_TOKEN"));
    }, $facades)
);

(new Route(
    new LazyHandler((new \Astaroth\Bootstrap\BotInstance($container))->bootstrap())))
    ->setClassMap($container->getParameter("APP_NAMESPACE"))
    ->handle();
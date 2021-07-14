<?php

$container = new \Symfony\Component\DependencyInjection\ContainerBuilder();
$configuration = (new \Astaroth\Auth\Configuration(dirname(__DIR__)))
    ->get();


array_walk($configuration, static fn($value, $key) => $container->setParameter($key, $value));

foreach (\HaydenPierce\ClassFinder\ClassFinder::getClassesInNamespace("Astaroth\Services") as $service) {
    $service = new $service;
    $service($container);
}

new \Astaroth\Support\Facades\Facade($container);


(new \Astaroth\Route\Route(
    new \Astaroth\Handler\LazyHandler((new \Astaroth\Bootstrap\BotInstance($container))->bootstrap())))
    ->setClassMap($container->getParameter("APP_NAMESPACE"))
    ->handle();
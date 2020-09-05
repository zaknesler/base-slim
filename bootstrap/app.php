<?php

use DI\Container;
use Dotenv\Dotenv;
use Slim\Views\Twig;
use Slim\Factory\AppFactory;
use Middlewares\TrailingSlash;
use Slim\Views\TwigMiddleware;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$container = new Container();
AppFactory::setContainer($container);

// Configure Twig views
$container->set('view', function () {
    return Twig::create(__DIR__ . '/../resources/views');
});

// Import settings from 'config/app.php'
$container->set('settings', include __DIR__ . '/../config/app.php');

// Configure Eloquent
$container->set('database', function () use ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;

    $capsule->addConnection($container->get('settings')['database']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
});

// Register containers
foreach ($container->get('settings')['container'] as $classKey => $class) {
    $container[$classKey] = fn () => new $class;
}

$app = AppFactory::create();

// Register Middleware
$app->add(new TrailingSlash(false));
$app->add(TwigMiddleware::createFromContainer($app));

// Register Routes
require_once __DIR__ . '/../routes/web.php';

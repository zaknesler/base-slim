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

// Import settings from 'config/app.php'
$container->set('settings', include __DIR__ . '/../config/app.php');

// Configure Twig views
$container->set('view', function ($container) {
    $view = Twig::create(__DIR__ . '/../resources/views');

    $view->getEnvironment()->addGlobal('app', $container->get('settings'));

    return $view;
});

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
    $container->set($classKey, fn () => new $class($container));
}

$app = AppFactory::create();

$container->set('app', fn () => $app);

// Register Middleware
$app->add(new TrailingSlash(false));
$app->add(TwigMiddleware::createFromContainer($app));

// Register Routes
require_once __DIR__ . '/../routes/web.php';

// Handle 404
$app->any('{route:.*}', function ($req, $res) use ($container) {
    return $container->get('view')
        ->render($res->withStatus(404), 'errors/404.twig');
});

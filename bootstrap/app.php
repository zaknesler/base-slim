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

$container->set('view', function () {
    return Twig::create(__DIR__ . '/../resources/views');
});

$container->set('settings', include __DIR__ . '/../config/app.php');

$container->set('database', function () use ($container) {
    $capsule = new \Illuminate\Database\Capsule\Manager;

    $capsule->addConnection($container->get('settings')['database']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
});

$app = AppFactory::create();

$app->add(new TrailingSlash(false));
$app->add(TwigMiddleware::createFromContainer($app));

require_once __DIR__ . '/../routes/web.php';

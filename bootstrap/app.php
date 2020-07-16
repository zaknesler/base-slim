<?php

use DI\Container;
use Dotenv\Dotenv;
use Slim\Views\Twig;
use Slim\Factory\AppFactory;
use Slim\Views\TwigMiddleware;

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$container = new Container();
AppFactory::setContainer($container);

$container->set('view', function () {
    return Twig::create(__DIR__ . '/../resources/views');
});

$app = AppFactory::create();

$app->add(TwigMiddleware::createFromContainer($app));

require_once __DIR__ . '/../routes/web.php';

<?php

namespace App\Controllers;

use DI\Container;
use Slim\Psr7\Response;

class Controller
{
    /**
     * The application's dependency container.
     *
     * @var \DI\Container
     */
    protected $container;

    /**
     * The response to the current request.
     *
     * @var \Slim\Psr7\Response
     */
    protected $response;

    /**
     * Create an instance of a controller.
     *
     * @param  \DI\Container  $container
     * @param  \Slim\Psr7\Response  $response
     */
    public function __construct(Container $container, Response $response)
    {
        $this->container = $container;
        $this->response = $response;
    }

    /**
     * Render a view with optional data.
     *
     * @param  string  $view
     * @param  array  $data
     * @return \Slim\Psr7\Response
     */
    public function render(string $view, array $data = [])
    {
        return $this->container->get('view')
            ->render($this->response, $view . '.twig', $data);
    }
}

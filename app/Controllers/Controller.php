<?php

namespace App\Controllers;

use DI\Container;
use Slim\Psr7\Response;
use Illuminate\Database\Capsule\Manager;

class Controller
{
    /**
     * The application's dependency container.
     *
     * @var \DI\Container
     */
    protected Container $c;

    /**
     * The response to the current request.
     *
     * @var \Slim\Psr7\Response
     */
    protected Response $response;

    /**
     * The current database connection.
     *
     * @var \Illuminate\Database\Capsule\Manager
     */
    protected Manager $db;

    /**
     * Create an instance of a controller.
     *
     * @param  \DI\Container  $container
     * @param  \Slim\Psr7\Response  $response
     */
    public function __construct(Container $container, Response $response)
    {
        $this->c = $container;
        $this->response = $response;
        $this->db = $this->c->get('database');
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
        return $this->c->get('view')
            ->render($this->response, $view . '.twig', $data);
    }
}

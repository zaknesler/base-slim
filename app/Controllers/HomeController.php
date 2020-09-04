<?php

namespace App\Controllers;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

class HomeController extends Controller
{
    /**
     * Show index view
     *
     * @param  \Slim\Psr7\Request  $request
     * @param  \Slim\Psr7\Response  $response
     * @return \Slim\Psr7\Response
     */
    public function index(Request $request, Response $response)
    {
        return $this->render('home', [
            'name' => env('APP_NAME'),
        ]);
    }
}

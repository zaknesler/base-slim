<?php

namespace App\Controllers;

class HomeController extends Controller
{
    public function index($request, $response)
    {
        return $this->container->get('view')->render($response, 'home.twig', [
            'name' => $_SERVER['APP_NAME'],
        ]);
    }
}

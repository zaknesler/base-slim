<?php

return [
    'name' => 'Slim',

    'container' => [
        //
    ],

    'database' => [
        'driver' => _env('DB_DRIVER', 'mysql'),
        'host' => _env('DB_HOST', 'localhost'),
        'database' => _env('DB_DATABASE', 'subscriptions'),
        'username' => _env('DB_USERNAME', 'root'),
        'password' => _env('DB_PASSWORD', ''),
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
    ],
];

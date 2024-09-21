<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $middleware = [
        // Lista de middlewares globais
    ];

    protected $middlewareGroups = [
        'web' => [
            // Middlewares do grupo web
        ],

        'api' => [
            // Middlewares do grupo api
        ],
    ];

    protected $routeMiddleware = [
        // Outros middlewares
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ];
}

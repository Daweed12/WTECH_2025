<?php

use PROJEKT_WTECH_2025\WTECH25_NYX\vendor\laravel\framework\src\Illuminate\Foundation\Application;
use PROJEKT_WTECH_2025\WTECH25_NYX\vendor\laravel\framework\src\Illuminate\Foundation\Configuration\Exceptions;
use PROJEKT_WTECH_2025\WTECH25_NYX\vendor\laravel\framework\src\Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

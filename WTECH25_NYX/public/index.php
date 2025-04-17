<?php

use PROJEKT_WTECH_2025\WTECH25_NYX\vendor\laravel\framework\src\Illuminate\Foundation\Application;
use PROJEKT_WTECH_2025\WTECH25_NYX\vendor\laravel\framework\src\Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());

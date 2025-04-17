<?php

use PROJEKT_WTECH_2025\WTECH25_NYX\vendor\laravel\framework\src\Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

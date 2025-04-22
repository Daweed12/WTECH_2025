<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $registered = true;
    return view('index', ["registered" => $registered]);
});

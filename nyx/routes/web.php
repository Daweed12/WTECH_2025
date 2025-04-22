<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $registered = false;
    $user_name = "David";

    return view('home.index', ["registered" => $registered, "user" => $user_name]);
});

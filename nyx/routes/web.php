<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/* Home */
Route::view('/', 'index')->name('home');

/* Zoznam produktov + filter params via GET */
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

/* Full-text search */
Route::get('/search', [ProductController::class, 'search'])
    ->name('products.search');

/* Detail produktu – musí ísť až po /products */
Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');

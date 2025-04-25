<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/* Home */
Route::view('/', 'index')->name('home');

/* Zoznam produktov */
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

/* Full-text search */
Route::get('/search', [ProductController::class, 'search'])
    ->name('products.search');

/* Detail produktu  ─ musí ísť až PO /products, inak by ho pohltilo {product} */
Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Hlavná stránka
|--------------------------------------------------------------------------
*/
Route::view('/', 'index')->name('home');

/*
|--------------------------------------------------------------------------
| Všetky produkty
|--------------------------------------------------------------------------
*/
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

/*
|--------------------------------------------------------------------------
| Vyhľadávanie
|--------------------------------------------------------------------------
*/
Route::get('/search', [ProductController::class, 'search'])
    ->name('products.search');

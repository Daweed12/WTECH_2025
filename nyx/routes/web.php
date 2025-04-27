<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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

Route::view('/account', 'login_register_user')
    ->middleware('guest')
    ->name('account');

Route::view('/auth', 'auth.login_register');

// login
Route::get('/login',  [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// register (show + submit)
Route::get( '/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// pre prihlásených
Route::middleware('auth')->group(function(){
    Route::view('/account', 'user.dashboard')->name('account');
    Route::post('/logout', [AuthenticatedSessionController::class,'destroy'])->name('logout');
});


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Product;

/* Home */
Route::view('/', 'index')->name('home');

/* Zoznam produktov + filter params via GET */
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

/* Vyhľadávanie */
Route::get('/products/search', [ProductController::class, 'search'])
    ->name('products.search');

/* Detail produktu – musí ísť až po /products */
Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');

/* Prihlasovacia / registračná obrazovka */
Route::view('/account', 'login_register_user')
    ->middleware('guest')
    ->name('account');

Route::view('/auth', 'auth.login_register');

/* Login */
Route::get( '/login',  [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

/* Register (form + submit) */
Route::get( '/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

/* Pre prihlásených */
Route::middleware('auth')->group(function () {

    Route::view('/account', 'account_details')->name('account');

    Route::put('/account', [AccountController::class, 'update'])
        ->name('account.update');

    Route::post('/logout', [AuthenticatedSessionController::class,'destroy'])
        ->name('logout');
});

/* ——— ADMIN sekcia ——— */

/* Dashboard: zoznam všetkých produktov */
Route::middleware(['auth'])
    ->get('/admin', function () {
        $products = Product::all();
        return view('admin.dashboard', compact('products'));
    })
    ->name('admin.dashboard');

/* Edit jedného produktu (view) */
Route::get('/admin/products/{product}/edit', function (Product $product) {
    return view('admin.admin_edit', compact('product'));
})
    ->middleware(['auth'])
    ->name('admin.products.edit');

/* Delete produktu */
Route::delete('/admin/products/{product}', function (Product $product) {
    $product->delete();
    return back()->with('success','Product deleted');
})
    ->middleware(['auth'])
    ->name('admin.products.destroy');


/* Update (PATCH) produktu */
Route::patch('/admin/products/{product}', function (\Illuminate\Http\Request $request, \App\Models\Product $product) {

    // minimálna validácia – prispôsob si
    $validated = $request->validate([
        'title'       => 'required|string|max:255',
        'price'       => 'required|numeric|min:0',
        'discount'    => 'nullable|integer|min:0',
        'category'    => 'nullable|string|max:255',
        'color'       => 'nullable|string|max:100',
        'gender'      => 'nullable|in:male,female,unisex',
        'description' => 'nullable|string',
        'summary'     => 'nullable|string|max:500',
        'details'     => 'nullable',
        'sku'         => 'nullable|string|max:100',
        'slug'        => 'nullable|string|max:255',
        'popularity'  => 'nullable|integer|min:0',
    ]);

    // ak „details“ prichádza ako JSON string
    if (is_string($validated['details'] ?? null)) {
        $validated['details'] = json_decode($validated['details'], true);
    }

    $product->update($validated);

    return back()->with('success', 'Product updated');
})
    ->middleware(['auth'])
    ->name('admin.products.update');


/* ----- Správa galérie obrázkov k produktu ----- */
Route::get('/admin/products/{product}/images', function (\App\Models\Product $product) {

    // zobrazí jednoduchý view s náhľadmi a možnosťou pridať / zmazať
    return view('admin.product_images', compact('product'));

})
    ->middleware(['auth'])
    ->name('admin.products.images.edit');

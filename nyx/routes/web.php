<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\Product;

/* Home */
Route::view('/', 'index')->name('home');

/* ───────────────────────────────── PRODUCTS ────────────────────────── */

/* Vyhľadávanie – / products/search  (musí byť pred resource) */
Route::get('/products/search', [ProductController::class, 'index'])
    ->name('products.search');

/* Vyhľadávanie – /search  (alias, ak formuláre smerujú sem) */
Route::get('/search', [ProductController::class, 'index']);

/* Katalóg (filtre cez GET) */
Route::get('/products', [ProductController::class, 'index'])
    ->name('products.index');

/* Detail produktu – len číselné ID → zabráni “search” → 22P02 */
Route::get('/products/{product}', [ProductController::class, 'show'])
    ->whereNumber('product')
    ->name('products.show');

/* ────────────────────────── AUTH / ACCOUNT ─────────────────────────── */

Route::view('/account', 'login_register_user')
    ->middleware('guest')
    ->name('account');

Route::view('/auth', 'auth.login_register');

Route::get( '/login',  [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::get( '/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::middleware('auth')->group(function () {

    Route::view('/account', 'account_details')->name('account');

    Route::put('/account', [AccountController::class, 'update'])
        ->name('account.update');

    Route::post('/logout', [AuthenticatedSessionController::class,'destroy'])
        ->name('logout');
});

/* ───────────────────────────── ADMIN ───────────────────────────────── */

Route::middleware(['auth'])
    ->get('/admin', function () {
        $products = Product::all();
        return view('admin.dashboard', compact('products'));
    })
    ->name('admin.dashboard');

Route::get('/admin/products/{product}/edit', function (Product $product) {
    return view('admin.admin_edit', compact('product'));
})
    ->middleware(['auth'])
    ->name('admin.products.edit');

Route::delete('/admin/products/{product}', function (Product $product) {
    $product->delete();
    return back()->with('success','Product deleted');
})
    ->middleware(['auth'])
    ->name('admin.products.destroy');

Route::patch('/admin/products/{product}', function (\Illuminate\Http\Request $request, Product $product) {

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

    if (is_string($validated['details'] ?? null)) {
        $validated['details'] = json_decode($validated['details'], true);
    }

    $product->update($validated);

    return back()->with('success', 'Product updated');
})
    ->middleware(['auth'])
    ->name('admin.products.update');

/* Galéria obrázkov */
Route::get('/admin/products/{product}/images', function (Product $product) {
    return view('admin.product_images', compact('product'));
})
    ->middleware(['auth'])
    ->name('admin.products.images.edit');

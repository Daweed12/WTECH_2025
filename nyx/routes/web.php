<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\{
    ProductController,
    CartController,
    OrderController,
    AccountController,
    AdminProductController
};
use App\Http\Controllers\Auth\{
    RegisterController,
    AuthenticatedSessionController
};
use App\Http\Middleware\IsAdmin;
use App\Models\Product;
use App\Http\Controllers\AdminProductImageController;

/* ───────────────────────────── HOME ───────────────────────────── */

Route::view('/', 'index')->name('home');

/* ───────────────────────────── CART ───────────────────────────── */

Route::get   ('/cart',              [CartController::class, 'preview'])->name('cart.preview');
Route::delete('/cart/remove/{item}',[CartController::class, 'remove' ])->name('cart.remove');
Route::get   ('/cart/address',      [CartController::class, 'showAddress'])->name('cart.address.form');
Route::post  ('/cart/address',      [CartController::class, 'saveAddress'])->name('cart.address');
Route::get   ('/cart/payment',      [CartController::class, 'showPayment'])->name('cart.payment.form');
Route::post  ('/cart/payment',      [CartController::class, 'savePayment'])->name('cart.payment');
Route::get   ('/cart/final',        [CartController::class, 'final'])->name('cart.final');

Route::post  ('/cart/add/{product}',[CartController::class, 'add'   ])->name('cart.add');
Route::patch ('/cart/update/{item}',[CartController::class, 'update'])->name('cart.update');

Route::post  ('/order',             [OrderController::class, 'store'  ])->name('order.store');
Route::get   ('/order/success/{order}', [OrderController::class, 'success'])->name('order.success');

/* ──────────────────────────── PRODUCTS ────────────────────────── */

Route::get('/products/search', [ProductController::class, 'index'])->name('products.search');
Route::get('/search',           [ProductController::class, 'index']);                 // alias
Route::get('/products',         [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product}',[ProductController::class, 'show'])
    ->whereNumber('product')
    ->name('products.show');

/* ──────────────────────── AUTH / ACCOUNT ──────────────────────── */

Route::view('/account', 'login_register_user')->middleware('guest')->name('account');
Route::view('/auth',    'auth.login_register');

Route::get ('/login',    [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login',    [AuthenticatedSessionController::class, 'store' ]);
Route::get ('/register', [RegisterController::class,            'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class,            'register']);

Route::middleware('auth')->group(function () {
    Route::view('/account', 'account_details')->name('account');
    Route::put ('/account', [AccountController::class, 'update' ])->name('account.update');
    Route::post('/logout',  [AuthenticatedSessionController::class,'destroy'])->name('logout');
});

/* ───────────────────────────── ADMIN ──────────────────────────── */

/* Dashboard (GET /admin) – stačí prihlásenie, rolu nekontrolujeme */
Route::middleware('auth')
    ->get('/admin', function () {
        /* eager-load obrázky, aby accessor nepýtal DB pri každom riadku */
        $products = Product::with('images')->latest()->get();
        return view('admin.dashboard', compact('products'));
    })
    ->name('admin.dashboard');

/* Všetky „CRUD“ routy len pre používateľov s rolou admin (middleware IsAdmin) */
Route::middleware(['auth', IsAdmin::class])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        /* ─── PRODUCTS GRID (GET /admin/products) ─── */
        Route::get('/products', function () {
            $products = Product::with('images')->latest()->get();
            return view('admin.dashboard', compact('products'));
        })->name('products.index');

        /* ─── CREATE (POST z modal-u) ─── */
        Route::post('/products', [AdminProductController::class, 'store'])
            ->name('products.store');

        /* ─── EDIT FORM ─── */
        Route::get('/products/{product}/edit', function (Product $product) {
            return view('admin.admin_edit', compact('product'));
        })->name('products.edit');

        /* ─── UPDATE ─── */
        Route::patch('/products/{product}', function (Request $request, Product $product) {

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
        })->name('products.update');

        /* ─── DELETE ─── */
        Route::delete('/products/{product}', function (Product $product) {
            $product->forceDelete();
            return back()->with('success', 'Product deleted');
        })->name('products.destroy');


        Route::get('/products/{product}/images', function (Product $product) {
            return view('admin.product_images', compact('product'));
        })->name('products.images.edit');

        /* ---------- obrázky produktu ---------- */
        Route::get   ('/products/{product}/images',
            [AdminProductImageController::class, 'edit'])
            ->name('products.images.edit');

        Route::post  ('/products/{product}/images',
            [AdminProductImageController::class, 'store'])
            ->name('products.images.store');

        Route::delete('/products/{product}/images/{image}',
            [AdminProductImageController::class, 'destroy'])
            ->name('products.images.destroy');
    });




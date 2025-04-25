<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Zoznam všetkých – alebo filtrovaných – produktov  ( /products )
     */
    public function index(Request $request)
    {
        // ?category=necklaces | rings | earings | bracelets …
        $category = $request->input('category');      // null → zobraz všetko

        $products = Product::with('images')
            ->when($category, function ($query) use ($category) {
                $query->where('category', $category);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();                      // zachová ?category= pri stránkovaní

        return view('all_products', compact('products', 'category'));
    }

    /**
     * Full-text vyhľadávanie  ( /search )
     */
    public function search(Request $request)
    {
        $q = trim($request->input('q', ''));

        $products = Product::with('images')
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('title',       'LIKE', "%{$q}%")
                        ->orWhere('description','LIKE', "%{$q}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();                      // zachová ?q= pri stránkovaní

        return view('all_products', [
            'products' => $products,
            'query'    => $q,
        ]);
    }

    /**
     * Detail konkrétneho produktu
     */
    public function show(Product $product)
    {
        $product->load('images');                     // N+1 fix
        return view('current_product', compact('product'));
    }
}

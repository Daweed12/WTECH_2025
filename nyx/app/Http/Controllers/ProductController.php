<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Všetky produkty ( /​products )
     */
    public function index()
    {
        $products = Product::with('images')
            ->latest()
            ->paginate(10);

        return view('all_products', compact('products'));
    }

    /**
     * Full-text vyhľadávanie ( /​search )
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
            ->withQueryString();   // zachová ?q= pri stránkovaní

        return view('all_products', [
            'products' => $products,
            'query'    => $q,
        ]);
    }

    public function show(Product $product)
    {
        // Dovliekni obrázky, aby nebol N+1
        $product->load('images');

        return view('current_product', compact('product'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // with('images') = žiadny N+1 problém
        $products = Product::with('images')
            ->latest()
            ->paginate(10);

        return view('all_products', compact('products'));
    }
}

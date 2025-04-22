<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // napr. načítaj všetky produkty
        $products = Product::paginate(12);
        return view('products.index', compact('products'));
    }

    // ... ostatné metódy create, store, edit, update, destroy
}

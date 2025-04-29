<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Zoznam všetkých – alebo filtrovaných – produktov ( /products )
     */
    public function index(Request $request)
    {
        $category  = $request->input('category');
        $colors    = array_filter(explode(',', $request->input('color', '')));
        $genders   = array_filter(explode(',', $request->input('gender', '')));
        $minPrice  = $request->input('min', 0);
        $maxPrice  = $request->input('max', 0);

        $products = Product::with('images')
            // Category
            ->when($category, function ($q) use ($category) {
                $q->whereRaw('LOWER(category) = ?', [Str::lower($category)]);
            })
            // Color
            ->when(count($colors), function ($q) use ($colors) {
                $q->whereIn('color', $colors);
            })
            // Gender
            ->when(count($genders), function ($q) use ($genders) {
                $q->whereIn('gender', $genders);
            })
            // Price range
            ->when($minPrice > 0, function ($q) use ($minPrice) {
                $q->where('price', '>=', $minPrice);
            })
            ->when($maxPrice > 0, function ($q) use ($maxPrice) {
                $q->where('price', '<=', $maxPrice);
            })
            ->paginate(20);

        return view('products.index', compact('products'));
    }

    /**
     * Full-textové vyhľadávanie ( /products/search?q=… )
     */
    public function search(Request $request)
    {
        $queryText = $request->input('q', '');

        $products = Product::with('images')
            ->where(function ($q) use ($queryText) {
                $q->where('title',       'ILIKE', "%{$queryText}%")
                    ->orWhere('description','ILIKE', "%{$queryText}%")
                    ->orWhere('summary',    'ILIKE', "%{$queryText}%")
                    ->orWhere('category',   'ILIKE', "%{$queryText}%");
            })
            ->paginate(20);

        return view('products.search', compact('products', 'queryText'));
    }

    /**
     * Detail jedného produktu
     */
    public function show(Product $product)
    {
        $product->load('images');

        // pridať do popularity jeden klik
        $product->increment('popularity');

        return view('products.show', compact('product'));
    }
}

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
        $colors    = $request->input('color', []);
        $genders   = $request->input('gender', []);    // ← new
        $minPrice  = $request->input('min_price', 0);
        $maxPrice  = $request->input('max_price', 500);
        $sort      = $request->input('sort', '');
        $queryText = $request->input('q', '');

        $products = Product::with('images')
            // Category
            ->when($category, function ($q) use ($category) {
                $q->whereRaw('LOWER(category) = ?', [Str::lower($category)]);
            })
            // Color (material)
            ->when(count($colors), function ($q) use ($colors) {
                $q->whereIn('color', $colors);
            })
            // Gender
            ->when(count($genders), function ($q) use ($genders) {
                $q->whereIn('gender', $genders);
            })
            // Search
            ->when($queryText, function ($q) use ($queryText) {
                $q->where(function ($sub) use ($queryText) {
                    $sub->where('title', 'LIKE', "%{$queryText}%")
                        ->orWhere('description', 'LIKE', "%{$queryText}%");
                });
            })
            // Price range
            ->whereBetween('price', [(float)$minPrice, (float)$maxPrice])
            // Sorting
            ->when($sort, function ($q) use ($sort) {
                return match($sort) {
                    'price-asc'  => $q->orderBy('price', 'asc'),
                    'price-desc' => $q->orderBy('price', 'desc'),
                    default      => $q->orderBy('choice', 'desc'),
                };
            }, fn($q) => $q->latest())
            // Paginate + preserve filters in query string
            ->paginate(10)
            ->withQueryString();

        return view('all_products', [
            'products'   => $products,
            'category'   => $category,
            'color'      => $colors,
            'gender'     => $genders,     // ← pass to view
            'min_price'  => $minPrice,
            'max_price'  => $maxPrice,
            'sort'       => $sort,
            'query'      => $queryText,
        ]);
    }

    /**
     * Full‐text vyhľadávanie (/search) — reuses index()
     */
    public function search(Request $request)
    {
        return $this->index($request);
    }

    /**
     * Detail konkrétneho produktu
     */
    public function show(Product $product)
    {
        $product->load('images');
        return view('current_product', compact('product'));
    }
}

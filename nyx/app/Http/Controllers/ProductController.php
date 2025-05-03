<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Zoznam / katalóg produktov.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | 1) Všetky vstupné parametre z URL
        |--------------------------------------------------------------------------
        */
        $category   = $request->input('category');          // string|null
        $colors     = $request->input('color', []);         // array
        $genders    = $request->input('gender', []);        // array
        $min_price  = $request->input('min_price');         // int|float|null
        $max_price  = $request->input('max_price');         // int|float|null
        $sort       = $request->input('sort', 'popularity'); // default
        $query      = $request->input('q');                 // full-text hľadanie

        /*
        |--------------------------------------------------------------------------
        | 2) Zostavenie Eloquent dotazu
        |--------------------------------------------------------------------------
        */
        $products = Product::query()

            // full-text / LIKE vyhľadávanie
            ->when($query, fn ($q) =>
            $q->where('title', 'like', "%{$query}%")
            )

            // kategória
            ->when($category, fn ($q) =>
            $q->where('category', $category)
            )

            // materiál / farba
            ->when($colors, fn ($q) =>
            $q->whereIn('material', $colors)
            )

            // gender
            ->when($genders, fn ($q) =>
            $q->whereIn('gender', $genders)
            )

            // min / max price
            ->when($min_price, fn ($q) =>
            $q->where('price', '>=', $min_price)
            )
            ->when($max_price, fn ($q) =>
            $q->where('price', '<=', $max_price)
            )

            // triedenie
            ->when(true, function ($q) use ($sort) {
                return match ($sort) {
                    'price-asc'  => $q->orderBy('price', 'asc'),
                    'price-desc' => $q->orderBy('price', 'desc'),
                    default      => $q->orderBy('popularity', 'desc'),
                };
            })

            // stránkovanie
            ->paginate(12)
            ->withQueryString();   // zachová všetky GET parametre na ďalších stránkach

        /*
        |--------------------------------------------------------------------------
        | 3) Odovzdanie dát do view
        |--------------------------------------------------------------------------
        |  — VŠETKY premenné, ktoré používa Blade, posielame explicitne —
        */
        return view('all_products', [
            'products'   => $products,
            'category'   => $category,
            'color'      => $colors,
            'gender'     => $genders,
            'min_price'  => $min_price,
            'max_price'  => $max_price,
            'sort'       => $sort,
            'query'      => $query,
        ]);
    }

    /**
     * Detail produktu.
     * (Ak ho používaš; ak nie, môžeš tento handler vymazať.)
     */
    public function show(Product $product)
    {
        return view('current_product', compact('product'));
    }
}

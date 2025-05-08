<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Katalóg + vyhľadávanie + filtre.
     */
    public function index(Request $request)
    {
        /* 1) parametre z URL ------------------------------------------------- */
        $category   = $request->input('category');
        $colors     = $request->input('color', []);
        $genders    = $request->input('gender', []);
        $min_price  = $request->input('min_price');
        $max_price  = $request->input('max_price');
        $sort       = $request->input('sort', 'popularity');
        $query      = $request->input('q');          // výraz na hľadanie

        /* 2) Eloquent dotaz -------------------------------------------------- */
        $products = Product::query()

            // full-text v title + slug  (ILIKE funguje v PostgreSQL)
            ->when($query, function ($q) use ($query) {
                $q->where('title', 'ilike', "%{$query}%")
                    ->orWhere('slug',  'ilike', "%{$query}%");
            })

            ->when($category, fn ($q) => $q->where('category', $category))
            ->when($colors,   fn ($q) => $q->whereIn('color', $colors))
            ->when($genders,  fn ($q) => $q->whereIn('gender', $genders))
            ->when($min_price,fn ($q) => $q->where('price', '>=', $min_price))
            ->when($max_price,fn ($q) => $q->where('price', '<=', $max_price))

            ->when(true, function ($q) use ($sort) {
                return match ($sort) {
                    'price-asc'  => $q->orderBy('price', 'asc'),
                    'price-desc' => $q->orderBy('price', 'desc'),

                    /* ✨  D O P L N I  ✨ */
                    'title-asc'  => $q->orderByRaw('LOWER(title) ASC'),   // A → Z
                    'title-desc' => $q->orderByRaw('LOWER(title) DESC'),  // Z → A

                    default      => $q->orderBy('popularity', 'desc'),
                };
            })

            ->when(true, function ($q) use ($sort) {
                return match ($sort) {
                    'price-asc'  => $q->orderBy('price', 'asc'),
                    'price-desc' => $q->orderBy('price', 'desc'),
                    default      => $q->orderBy('popularity', 'desc'),
                };
            })

            ->paginate(12)
            ->withQueryString();

        /* 3) View ------------------------------------------------------------ */
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

    /** Detail produktu */
    public function show(Product $product)
    {
        return view('current_product', compact('product'));
    }

    /** alias /search → index() (zachovaná kompatibilita) */
    public function search(Request $request)
    {
        return $this->index($request);
    }
}

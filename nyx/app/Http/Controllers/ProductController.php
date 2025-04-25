<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Zoznam všetkých – alebo filtrovaných – produktov ( /products )
     */
    public function index(Request $request)
    {
        $category = $request->input('category');
        $sort     = $request->input('sort', '');

        $products = Product::with('images')
            ->when($category, function ($q) use ($category) {
                $q->where('category', $category);
            })
            ->when($sort, function ($q) use ($sort) {
                switch ($sort) {
                    case 'price-asc':
                        $q->orderBy('price', 'asc');
                        break;
                    case 'price-desc':
                        $q->orderBy('price', 'desc');
                        break;
                    case 'popularity':
                        $q->orderBy('choice', 'desc');
                        break;
                }
            }, function ($q) {
                $q->latest();
            })
            ->paginate(10)
            ->withQueryString();

        return view('all_products', [
            'products' => $products,
            'category' => $category,
            'sort'     => $sort,
            'query'    => $request->input('q', ''),
        ]);
    }

    /**
     * Full-text vyhľadávanie ( /search )
     */
    public function search(Request $request)
    {
        $q = trim($request->input('q', ''));

        $products = Product::with('images')
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('title', 'LIKE', "%{$q}%")
                        ->orWhere('description', 'LIKE', "%{$q}%");
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

    /**
     * Detail konkrétneho produktu
     */
    public function show(Product $product)
    {
        $product->load('images');  // vyhni sa N+1
        return view('current_product', compact('product'));
    }
}

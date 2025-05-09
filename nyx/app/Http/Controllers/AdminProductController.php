<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    /**
     * Uloženie nového produktu z admin-dashboardu
     */
    public function store(Request $request)
    {
        /* ─── VALIDÁCIA ─── */
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'sku'         => 'nullable|string|max:100|unique:products,sku',
            'slug'        => 'nullable|string|max:255',
            'price'       => 'required|numeric|min:0',
            'discount'    => 'nullable|integer|min:0',
            'category'    => 'required|string|max:255',
            'color'       => 'nullable|string|in:silver,gold,diamond',
            'gender'      => 'nullable|in:male,female,unisex',
            'details'      => 'nullable|string|max:255',
            'description' => 'required|string',
            'summary'     => 'nullable|string',
            'popularity'  => 'nullable|integer|min:0',
            'images'      => 'required|array|between:2,4',
            'images.*'    => 'image|max:5120',                 // 5 MB / kus
        ]);


        $data['discount']   ??= 0;   // ak je null, nastaví 0
        $data['popularity'] ??= 0;   // dtto

        /* ─── UNIKÁTNY SLUG ─── */
        $baseSlug = Str::slug($data['title']);
        $slug     = $data['slug'] ?: $baseSlug;
        $i        = 1;
        while (Product::where('slug', $slug)->exists()) {
            $slug = $baseSlug.'-'.$i++;
        }
        $data['slug'] = $slug;

        /* ─── AUTO-SKU, AK CHÝBA ─── */
        $data['sku'] = $data['sku'] ?: strtoupper(Str::random(8));

        /* ─── VYTVOR PRODUKT (bez obrázkov) ─── */
        $product = Product::create(collect($data)->except('images')->toArray());

        /* ─── UPLOAD OBRÁZKOV & PIVOT product_images ─── */
        foreach ($request->file('images') as $file) {
            $storedPath = $file->store('products', 'public');        // storage/app/public/products/…
            $image      = Image::create(['url' => $storedPath]);      // uloží záznam do tabuľky images
            $product->images()->attach($image->id);                  // pivot product_images
        }

        return back()->with('success', 'Product for successfully added');
    }
}

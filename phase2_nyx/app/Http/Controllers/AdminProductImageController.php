<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Image;
use Illuminate\Http\Request;

class AdminProductImageController extends Controller
{
    /* --------- FORMULÁR (GET) --------- */
    public function edit(Product $product)
    {
        // eager-load images, nech nie je N+1
        $product->load('images');

        return view('admin.product_images', compact('product'));
    }

    /* --------- UPLOAD NOVÝCH (POST) --------- */
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'images'   => 'required|array|between:1,5',
            'images.*' => 'image|max:5120', // 5 MB
        ]);

        foreach ($request->file('images') as $file) {
            $path  = $file->store('products', 'public');
            $image = Image::create(['url' => $path]);
            $product->images()->attach($image->id);
        }

        return back()->with('success', 'Images uploaded');
    }

    /* --------- DELETE (DELETE) --------- */
    public function destroy(Product $product, Image $image)
    {
        // odpoj z pivotu a odstráň záznam aj súbor
        $product->images()->detach($image->id);
        \Storage::disk('public')->delete($image->url);
        $image->delete();

        return back()->with('success', 'Image deleted');
    }
}

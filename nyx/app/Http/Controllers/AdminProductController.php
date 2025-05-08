<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    /**
     * Store a new product: only title, description, ≥2 photos required.
     * Other columns filled with defaults. Photos are renamed to
     *   products/<category>/product{ID}-{n}.jpg
     */
    public function store(Request $request)
    {
        /* 1) Validation -------------------------------------------------- */
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'images'      => ['required','array','min:2','max:5'],
            'images.*'    => ['image','mimes:jpeg,png,webp','max:2048'],
        ]);

        /* 2) Transaction ------------------------------------------------- */
        DB::transaction(function () use ($data, $request) {

            /* Defaults for columns, can tweak as needed */
            $defaults = [
                'sku'        => strtoupper(Str::random(8)),
                'price'      => 0,
                'discount'   => 0,
                'category'   => 'uncategorized',
                'color'      => 'n/a',
                'gender'     => 'unisex',
                'detail'     => null,
                'summary'    => null,
                'popularity' => 0,
            ];

            /* ⇢ create product */
            $product = Product::create(array_merge($defaults, [
                'title'       => $data['title'],
                'slug'        => Str::slug($data['title']).'-'.Str::random(4),
                'description' => $data['description'],
            ]));

            /* ⇢ Save images with naming convention product{ID}-{n}.ext */
            $categoryFolder = Str::slug($product->category ?? 'misc');
            $index = 1;
            foreach ($request->file('images') as $file) {
                $ext      = $file->getClientOriginalExtension();
                $filename = "product{$product->id}-{$index}.{$ext}";
                $path     = $file->storeAs("products/{$categoryFolder}", $filename, 'public');

                // first image → optional first_image_url column (used in dashboard)
                if ($index === 1 && \Schema::hasColumn('products', 'first_image_url')) {
                    $product->first_image_url = $path;
                    $product->save();
                }

                // store in images relation if it exists
                if (method_exists($product, 'images')) {
                    $product->images()->create(['url' => $path]);
                }
                $index++;
            }
        });

        return back()->with('success', 'Product added!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    /** POST /admin/products */
    public function store(Request $request)
    {
        /* ---------- 1. VALIDÁCIA ---------- */
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            // ⬇︎ povolí 1–5 obrázkov namiesto presne 2
            'images'      => ['required', 'array', 'between:1,5'],
            'images.*'    => ['image', 'mimes:jpeg,png,webp', 'max:5120'], // 5 MB/kus
        ]);

        /* ---------- 2. DB transakcia ---------- */
        DB::transaction(function () use ($data, $request) {

            /* základné hodnoty, ktoré môžeš neskôr prepísať vo forme */
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

            /* vytvor produkt */
            $product = Product::create(array_merge($defaults, [
                'title'       => $data['title'],
                'slug'        => Str::slug($data['title']) . '-' . Str::random(4),
                'description' => $data['description'],
            ]));

            /* upload obrázkov */
            $folder = Str::slug($product->category);
            $index  = 1;

            foreach ($request->file('images') as $file) {
                $ext      = $file->getClientOriginalExtension();
                $filename = "product{$product->id}-{$index}.{$ext}";
                $path     = $file->storeAs("products/{$folder}", $filename, 'public');

                /* prvý obrázok – rýchla url pre grid */
                if ($index === 1 && \Schema::hasColumn('products', 'first_image_url')) {
                    $product->first_image_url = $path;
                    $product->save();
                }

                /* ak používaš pivot tabuľku product_images */
                if (method_exists($product, 'images')) {
                    $product->images()->create(['url' => $path]);
                }

                $index++;
            }
        });

        return back()->with('success', 'Product bol úspešne pridaný!');
    }
}

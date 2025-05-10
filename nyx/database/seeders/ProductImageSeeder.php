<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductImageSeeder extends Seeder
{
    public function run()
    {
        // Načítame všetky produkty zoradené podľa ID
        $products = Product::orderBy('id')->get();

        foreach ($products as $product) {
            // prvé ID obrázka pre daný produkt
            $firstImageId = ($product->id - 1) * 4 + 1;

            // range() vygeneruje [1,2,3,4] → [5,6,7,8] → …
            $imageIds = range($firstImageId, $firstImageId + 3);

            // pripojíme 4 obrázky k produktu
            $product->images()->attach($imageIds);
        }
    }
}

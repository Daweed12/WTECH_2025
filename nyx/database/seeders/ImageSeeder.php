<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;

class ImageSeeder extends Seeder
{
    public function run()
    {
        // presná mapa kategória => zoznam produkt ID
        $map = [
            'rings'      => range(1, 5),
            'bracelets'  => range(6, 10),
            'necklaces'  => range(11, 15),
            'earrings'   => range(16, 20),
        ];

        foreach ($map as $category => $productIds) {
            foreach ($productIds as $productId) {
                for ($i = 1; $i <= 4; $i++) {
                    Image::create([
                        'url' => "products/{$category}/product{$productId}-{$i}.jpg",
                    ]);
                }
            }
        }
    }
}

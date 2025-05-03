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
            'rings'     => array_merge(range(1, 5), range(31, 35)),
            'bracelets'  => range(26, 30), //array_merge(range(41, 45),range(26, 30)),
            'necklaces'  => array_merge(range(6, 15),range(21, 25)),
            'earrings'   => array_merge(range(16, 20),range(36, 40)),
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

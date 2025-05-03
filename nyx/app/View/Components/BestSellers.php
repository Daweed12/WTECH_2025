<?php

namespace App\View\Components;

use App\Models\Product;               //  ←  DÔLEŽITÉ
use Illuminate\View\Component;

class BestSellers extends Component
{
    public function __construct(public int $limit = 4) {}

    public function render()
    {
        $products = Product::bestSellers($this->limit)->get();

        return view('components.best-sellers', [
            'products' => $products,   //  ←  pošli do Blade súboru
        ]);
    }
}

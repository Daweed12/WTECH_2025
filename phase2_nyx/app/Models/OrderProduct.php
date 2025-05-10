<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    // explicitne pomenovať tabuľku
    protected $table = 'order_products';

    protected $fillable = [
        'order_id',
        'product_id',
        'sku',
        'price',
        'discount',
        'quantity',
    ];

    /**
     * Vzťah na objednávku.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Vzťah na produkt.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

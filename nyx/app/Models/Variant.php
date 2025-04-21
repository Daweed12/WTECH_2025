<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Variant extends Model
{
    protected $fillable = ['product_id', 'sku', 'size', 'quantity', 'price_override'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CategoryProduct extends Pivot
{
    // Názov tabuľky, ak nie je defaultné category_product
    protected $table = 'category_product';

    // Pivot tabuľky obyčajne nemajú timestampy
    public $timestamps = false;

    protected $fillable = ['product_id', 'category_id'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

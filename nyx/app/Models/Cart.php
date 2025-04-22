<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'session_id', 'token', 'status',
    ];

    /* ---------- relationships ---------- */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 1:N – radšej explicitný model CartProduct (obsahuje množstvo, cenu…)
    public function items()
    {
        return $this->hasMany(CartProduct::class);
    }

    // praktická skratka – ktoré produkty sú v košíku (cez CartProduct)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_products')
            ->withPivot(['sku', 'price', 'discount', 'quantity', 'active'])
            ->withTimestamps();
    }
}

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

    /**
     * One-to-many relationship: CartProduct holds quantity, price, etc.
     */
    public function items()
    {
        return $this->hasMany(CartProduct::class);
    }

    /**
     * Shortcut to products in the cart via pivot table
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_products')
            ->withPivot(['sku', 'price', 'discount', 'quantity', 'active'])
            ->withTimestamps();
    }

    /**
     * Calculate subtotal: sum of (quantity * unit price) for each item
     *
     * @return float
     */
    public function subtotal(): float
    {
        return $this->items
            ->reduce(fn($sum, CartProduct $item) => $sum + ($item->price * $item->quantity), 0.0);
    }

    /**
     * Total amount for the cart; currently same as subtotal
     * Can include additional fees or discounts later
     *
     * @return float
     */
    public function total(): float
    {
        return $this->subtotal();
    }
}

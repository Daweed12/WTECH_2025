<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Ak používaš guarded miesto fillable, uprav podľa svojho štýlu
    protected $fillable = [
        'user_id',
        'session_id',
        'address_id',
        'delivery_method_id',
        'payment_method_id',
        'total_price',
        'delivery_fee',
        'payment_fee',
        'discount',
        'status',
    ];

    /**
     * Používateľ, ktorý zadal objednávku.
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Adresa pre túto objednávku.
     */
    public function address()
    {
        return $this->belongsTo(\App\Models\Address::class);
    }

    /**
     * Zvolená metóda dopravy.
     */
    public function deliveryMethod()
    {
        return $this->belongsTo(\App\Models\DeliveryMethod::class);
    }

    /**
     * Zvolená metóda platby.
     */
    public function paymentMethod()
    {
        return $this->belongsTo(\App\Models\PaymentMethod::class);
    }

    /**
     * Položky/riadky objednávky.
     * Predpokladá sa, že máte model OrderItem, ktorý ukladá product_id, quantity, price a order_id.
     */
    public function items()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }
}

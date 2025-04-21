<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    protected $fillable = ['code', 'discount_type', 'amount', 'valid_from', 'valid_to'];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}

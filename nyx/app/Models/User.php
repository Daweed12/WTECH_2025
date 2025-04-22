<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password_hash',
        'phone',
    ];

    /* ---------- relationships ---------- */

    // 1:N – užívateľ môže mať viac košíkov (anon + prihlásený)
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // M:N – fakturačné / doručovacie adresy
    public function addresses()
    {
        return $this->belongsToMany(Address::class, 'user_address')
            ->withTimestamps();
    }

    // 1:N – objednávky
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // 1:N – recenzie
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

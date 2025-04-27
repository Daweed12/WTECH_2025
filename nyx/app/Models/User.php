<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
    ];

    /**
     * The attributes that should be hidden for arrays (e.g. toArray(), JSON).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* ---------- relationships ---------- */

    // 1:N – a user can have many carts
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // M:N – billing/shipping addresses
    public function addresses()
    {
        return $this->belongsToMany(Address::class, 'user_address')
            ->withTimestamps();
    }

    // 1:N – orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // 1:N – reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'country', 'city',
        'address_line_1', 'address_line_2',
        'zip',
    ];

    /* ---------- relationships ---------- */

    // M:N s pivotom user_address
    public function user()
    {
        return $this->hasOneThrough(
            User::class,
            UserAddress::class,
            'address_id',
            'id',
            'id',
            'user_id'
        );
    }

    // 1:N – objednávky, ktoré sa posielajú na túto adresu
    public function orders()
    {
        return $this->hasMany(Order::class, 'shipping_address_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name',
        'address_line_1','city',
        'zip','country','phone',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_address')
            ->withTimestamps();
    }


    // 1:N – objednávky, ktoré sa posielajú na túto adresu
    public function orders()
    {
        return $this->hasMany(Order::class, 'shipping_address_id');
    }
}

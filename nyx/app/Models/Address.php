<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    protected $fillable = ['country', 'city', 'address_line1', 'address_line2', 'zip'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'shipping_address_id');
    }
}

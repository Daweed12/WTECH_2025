<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAddress extends Pivot
{
    // Ak si tabuľku nazval user_address
    protected $table = 'user_address';
    public $timestamps = false;

    protected $fillable = ['user_id', 'address_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}

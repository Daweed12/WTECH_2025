<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    // Ak názov tabuľky nezodpovedá snake-case plurálnej forme (tu zodpovedá),
    // nemusíš špecifikovať protected $table.
    // protected $table = 'payment_methods';

    protected $fillable = [
        'name',
        'fee',
    ];
}

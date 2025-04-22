<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;   // ← doplň
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;   // ← doplň

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
    ];
}

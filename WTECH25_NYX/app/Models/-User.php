<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use PROJEKT_WTECH_2025\WTECH25_NYX\vendor\laravel\framework\src\Illuminate\Database\Eloquent\Factories\HasFactory;
use PROJEKT_WTECH_2025\WTECH25_NYX\vendor\laravel\framework\src\Illuminate\Foundation\Auth\User as Authenticatable;
use PROJEKT_WTECH_2025\WTECH25_NYX\vendor\laravel\framework\src\Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\PROJEKT_WTECH_2025\WTECH25_NYX\database\factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'sku',
        'slug',
        'price',
        'discount',
        'category',
        'color',
        'gender',
        'description',
        'summary',
    ];

    /* ---------- príklady vzťahov ---------- */
    public function images()
    {
        return $this->belongsToMany(Image::class, 'product_images'); // bez ->withTimestamps()
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}

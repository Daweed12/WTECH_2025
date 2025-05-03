<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Image;   // vzťah na obrázky

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Hromadné priraďovanie
     */
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
        'details',
        'popularity',
    ];

    /**
     * Casty – ak budeš „details“ ukladať ako JSON pole,
     * odkomentuj nasledujúci riadok
     */
    // protected $casts = [
    //     'details' => 'array',
    // ];

    /**
     * N:M vzťah – produkt ↔ obrázky
     */
    public function images()
    {
        return $this->belongsToMany(
            Image::class,
            'product_images',   // ← ak je táto tabuľka skutočne product_image
            'product_id',
            'image_id'
        );
    }

    /**
     * Accessor: url prvého obrázka alebo fallback
     */
    public function getFirstImageUrlAttribute(): string
    {
        $rawUrl = $this->images->first()->url ?? null;

        return $rawUrl
            ? asset('storage/' . ltrim($rawUrl, '/'))
            : asset('storage/defaults/no-image.png');
    }

    public function scopeBestSellers($query, int $limit = 4)
    {
        return $query->orderByDesc('popularity')
            ->take($limit);
    }

}

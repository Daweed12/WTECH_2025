<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /* ---------- hromadné priraďovanie ---------- */
    protected $fillable = [
        'title', 'sku', 'slug', 'price', 'discount',
        'category', 'color', 'gender', 'details',
        'description', 'summary', 'popularity', // „images“ netreba, idú pivotom
    ];

    /* ---------- pretypovanie stĺpcov ---------- */
    protected $casts = [
        // ak by si niekedy chcel obrázky aj ako JSON stĺpec
        // 'images' => 'array',
    ];

    /* ---------- N:M vzťah – produkt ↔ obrázky ---------- */
    public function images()
    {
        return $this->belongsToMany(
            Image::class,
            'product_images',       // pivot tabuľka
            'product_id',
            'image_id'
        );
    }

    /* ---------- accessor: prvá fotka alebo fallback ---------- */
    public function getFirstImageUrlAttribute(): string
    {
        $rawUrl = $this->images->first()->url ?? null;

        return $rawUrl
            ? asset('storage/' . ltrim($rawUrl, '/'))
            : asset('storage/defaults/no-image.png');
    }

    /* ---------- alias na náhľad (ak ho niekde voláš) ---------- */
    public function getThumbnailUrlAttribute(): string
    {
        return $this->getFirstImageUrlAttribute();
    }

    /* ---------- scope: best-sellers ---------- */
    public function scopeBestSellers($query, int $limit = 4)
    {
        return $query->orderByDesc('popularity')->take($limit);
    }

    /* ---------- auto-slug a auto-SKU ---------- */
    protected static function booted(): void
    {
        static::creating(function (self $product) {
            if (!$product->sku) {
                $product->sku = strtoupper(Str::random(8));
            }

            if (!$product->slug) {
                $base   = Str::slug($product->title);
                $slug   = $base;
                $count  = 1;

                while (self::where('slug', $slug)->exists()) {
                    $slug = $base . '-' . $count++;
                }
                $product->slug = $slug;
            }
        });
    }
}

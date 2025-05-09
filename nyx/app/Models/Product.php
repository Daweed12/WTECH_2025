<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Image;                 // pivot vzťah

class Product extends Model
{
    use HasFactory;

    /* ---------- mass-assign ---------- */
    protected $fillable = [
        'title', 'sku', 'slug', 'price', 'discount',
        'category', 'color', 'gender', 'details',
        'description', 'summary', 'popularity',
    ];

    /* ---------- casty ---------- */
    protected $casts = [
        // 'images' => 'array', // ak by si niekedy ukladal JSON
    ];

    /* ---------- N:M – product ↔ images ---------- */
    public function images()
    {
        return $this->belongsToMany(
            Image::class,
            'product_images',
            'product_id',
            'image_id'
        );
    }

    /* ---------- accessor: prvá fotka alebo fallback ---------- */
    public function getFirstImageUrlAttribute(): string
    {
        $rawUrl = $this->images->first()->url ?? null;

        return $rawUrl
            ? asset('storage/'.ltrim($rawUrl, '/'))
            : asset('storage/defaults/no-image.png');
    }

    /* alias */
    public function getThumbnailUrlAttribute(): string
    {
        return $this->getFirstImageUrlAttribute();
    }

    /* ---------- scope: best-sellers ---------- */
    public function scopeBestSellers($query, int $limit = 4)
    {
        return $query->orderByDesc('popularity')->take($limit);
    }

    /* ---------- booted – auto-slug/SKU + hard-delete obrázkov ---------- */
    protected static function booted(): void
    {
        parent::booted();   // zachová prípadné eventy z parentu

        /* auto SKU + slug pri vytváraní */
        static::creating(function (self $product) {
            if (!$product->sku) {
                $product->sku = strtoupper(Str::random(8));
            }

            if (!$product->slug) {
                $base  = Str::slug($product->title);
                $slug  = $base;
                $count = 1;
                while (self::where('slug', $slug)->exists()) {
                    $slug = $base.'-'.$count++;
                }
                $product->slug = $slug;
            }
        });

        /* hard delete – zo súborového systému aj z tabuľky images */
        static::deleting(function (self $product) {
            // načítaj images len raz
            $product->loadMissing('images');

            foreach ($product->images as $image) {
                // 1) fyzicky zmaž súbor
                \Storage::disk('public')->delete($image->url);

                // 2) zmaž riadok z `images`
                $image->delete();          // pivot sa odpojí kaskádou
            }
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Ak používaš guarded/fillable, doplň sem...

    /** Vzťah N:M – produkt ↔ obrázky */
    public function images()
    {

        return $this->belongsToMany(
            Image::class,        // model Image
            'product_images',    // názov pivot tabuľky  <-- dôležité!
            'product_id',        // foreignPivotKey
            'image_id'           // relatedPivotKey
        );
    }

    /** Accessor na prvý obrázok (alebo fallback) */
    public function getFirstImageUrlAttribute(): string
    {
        // eager-loadom budeme mať $this->images už načítané
        $rawUrl = $this->images->first()->url ?? null;

        // keď je uložená relatívna cesta,
        //   → pripojíme public/storage (ak súbory sú v storage/app/public)
        return $rawUrl
            ? asset('storage/' . ltrim($rawUrl, '/'))
            : asset('storage/defaults/no-image.png');
    }
}

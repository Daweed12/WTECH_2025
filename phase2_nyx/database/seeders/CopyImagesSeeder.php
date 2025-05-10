<?php

// database/seeders/CopyImagesSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class CopyImagesSeeder extends Seeder
{
    public function run(): void
    {
        $from = database_path('seeders/assets/products');          // zdroj
        $to   = storage_path('app/public/products');               // cieľ

        // vymaž cieľový priečinok a nakopíruj nanovo
        File::deleteDirectory($to);
        File::copyDirectory($from, $to);

        $this->command->info('✅ Obrázky skopírované do storage/app/public/products');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AssetSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Ensure the public/storage symlink exists
        if (! is_link(public_path('storage'))) {
            $this->command->info('Please run `php artisan storage:link` first.');
        }

        // 2) Copy banners
        $bannerSrc = database_path('seeders/assets/banners');
        if (File::exists($bannerSrc)) {
            Storage::disk('public')->makeDirectory('banners');
            File::copyDirectory($bannerSrc, storage_path('app/public/banners'));
            $this->command->info('Banners copied.');
        }

        // 3) Copy icons
        $iconsSrc = database_path('seeders/assets/icons');
        if (File::exists($iconsSrc)) {
            Storage::disk('public')->makeDirectory('icons');
            File::copyDirectory($iconsSrc, storage_path('app/public/icons'));
            $this->command->info('Icons copied.');
        }

        // 4) Copy products (with sub-folders, e.g. bracelets, earrings…)
        $productsSrc = database_path('seeders/assets/products');
        if (File::exists($productsSrc)) {
            foreach (File::directories($productsSrc) as $dir) {
                $category = basename($dir);
                Storage::disk('public')->makeDirectory("products/{$category}");
                File::copyDirectory(
                    $dir,
                    storage_path("app/public/products/{$category}")
                );
            }
            $this->command->info('Product assets copied.');
        }
    }
}

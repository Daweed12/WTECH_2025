<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Address;

class AddressSeeder extends Seeder
{
    /**
     * Spustí sa pri php artisan db:seed --class=AddressSeeder
     */
    public function run(): void
    {
        // prispôsob si počet záznamov podľa potreby
        Address::factory()->count(10)->create();
    }
}

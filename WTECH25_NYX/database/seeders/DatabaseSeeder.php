<?php

namespace Database\Seeders;

use PROJEKT_WTECH_2025\WTECH25_NYX\app\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use PROJEKT_WTECH_2025\WTECH25_NYX\vendor\laravel\framework\src\Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}

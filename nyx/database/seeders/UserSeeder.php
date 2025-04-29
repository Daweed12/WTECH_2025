<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // vytvor 50 fake používateľov
        User::factory(50)->create();

        // ak chceš aj jedného administrátora:
        User::factory()->create([
            'first_name' => 'Admin',
            'last_name'  => 'User',
            'email'      => 'admin@example.com',
            'password'   => bcrypt('admin123'),
            'phone'      => '+421900000000',
            'role'       => 1,
        ]);
    }
}

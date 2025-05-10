<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryMethodsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('delivery_methods')->insert([
            ['name' => 'Standart (2–5 days)', 'fee' => 3.99, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Express (1–2 days)',   'fee' => 7.50, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Personal takeaway',         'fee' => 0.00, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

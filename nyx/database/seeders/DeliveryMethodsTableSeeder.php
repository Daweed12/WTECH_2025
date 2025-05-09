<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliveryMethodsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('delivery_methods')->insert([
            ['name' => 'Štandardná (2–5 dní)', 'fee' => 3.99, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Expresná (1–2 dni)',   'fee' => 7.50, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Osobný odber',         'fee' => 0.00, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('payment_methods')->insert([
            ['name' => 'Card', 'fee' => 0.00, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pay on deliver',    'fee' => 2.50, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'PayPal',      'fee' => 1.00, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

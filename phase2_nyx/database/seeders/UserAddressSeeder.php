<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Address;
use Illuminate\Support\Facades\DB;

class UserAddressSeeder extends Seeder
{
    public function run(): void
    {
        // RESET pivotu, aby sme začali nanovo (voliteľné)
        DB::table('user_address')->truncate();

        $users    = User::inRandomOrder()->get();          // premiešame
        $addresses = Address::inRandomOrder()->get();

        // ak je adries menej než userov → vytvoríme chýbajúce
        if ($addresses->count() < $users->count()) {
            $diff = $users->count() - $addresses->count();
            $addresses = $addresses
                ->merge(Address::factory()->count($diff)->create());
        }

        // priraď každému userovi prvú voľnú adresu
        $addressIterator = $addresses->values(); // indexované 0…n
        foreach ($users as $index => $user) {
            $addressId = $addressIterator[$index]->id;

            DB::table('user_address')->insert([
                'user_id'    => $user->id,
                'address_id' => $addressId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

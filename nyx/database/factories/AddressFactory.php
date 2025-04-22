<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition(): array
    {
        return [
            'country'         => $this->faker->country(),
            'city'            => $this->faker->city(),
            'address_line_1'  => $this->faker->streetAddress(),
            'address_line_2'  => $this->faker->boolean(60) ? $this->faker->secondaryAddress() : null,
            'zip'             => $this->faker->postcode(),
        ];
    }
}

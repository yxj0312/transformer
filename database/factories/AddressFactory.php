<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->stateAbbr,
            'country' => $this->faker->country,
            'postal_code' => $this->faker->postcode,
            'phone_number' => $this->faker->phoneNumber,
            'company_name' => $this->faker->optional()->company,
            'apartment_number' => $this->faker->optional()->buildingNumber,
            'is_default' => false,
        ];
    }
}

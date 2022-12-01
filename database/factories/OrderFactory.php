<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => null,
            'billing_email' => $this->faker->email(),
            'billing_name' => ucwords($this->faker->words(4, true)),
            'billing_address' => $this->faker->address(),
            'billing_city' => $this->faker->city(),
            'billing_province' => $this->faker->words(4, true),
            'billing_postalcode' => $this->faker->postcode(),
            'billing_phone' => $this->faker->phoneNumber(),
            'billing_name_on_card' => ucwords($this->faker->words(4, true)),
            'billing_discount' => 0,
            'billing_discount_code' => null,
            'billing_subtotal' => 12345,
            'billing_tax' => 1605,
            'billing_total' => 13950,
            'error' => null,
        ];
    }
}

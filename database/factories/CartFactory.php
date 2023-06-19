<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
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
            'shipping_address_id' => null,
            'billing_address_id' => null,
            'session_id' => $this->faker->uuid,
            'total_items' => $this->faker->numberBetween(0, 10),
            'total_price' => $this->faker->randomFloat(2, 0, 1000),
            'discount' => $this->faker->randomFloat(2, 0, 100),
            'coupon_code' => $this->faker->randomNumber(6),
            'notes' => $this->faker->sentence(),
            'is_checked_out' => false,
            'checked_out_at' => null,
        ];
    }
}

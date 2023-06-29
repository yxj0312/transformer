<?php

namespace Database\Factories;

use App\Models\OrderStatus;
use App\Models\PaymentMethod;
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
            'user_id' => User::factory(),
            'payment_method_id' => PaymentMethod::factory(),
            'order_status_id' => OrderStatus::factory(),
            'total_amount' => $this->faker->randomFloat(2, 10, 100),
            'currency' => $this->faker->currencyCode,
            'payment_status' => $this->faker->randomElement(['pending', 'paid', 'failed']),
            'shipping_method' => $this->faker->randomElement(['express', 'standard']),
            'tracking_number' => $this->faker->optional()->numberBetween(100000, 999999),
            'shipping_address' => $this->faker->optional()->address,
            'billing_address' => $this->faker->optional()->address,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}

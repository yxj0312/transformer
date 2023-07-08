<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->word(),
            'discount_amount' => $this->faker->randomFloat(2, 1, 100),
            'discount_type' => $this->faker->randomElement(['fixed', 'percentage']),
            'couponable_id' => Product::factory(),
            'couponable_type' => Product::class,
        ];
    }
}

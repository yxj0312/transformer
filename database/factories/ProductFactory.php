<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => ucwords($this->faker->words(4, true)),
            'slug' => $this->faker->slug,
            'description' => $this->faker->paragraph(5),
            'price' => $this->faker->randomFloat(2, 20, 1000),
            'image' => 'products/dummy/laptop-1.jpg',
            'quantity' => 10,
        ];
    }
}
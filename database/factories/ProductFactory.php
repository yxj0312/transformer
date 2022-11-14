<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
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

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $product->categories()
                ->attach(Category::inRandomOrder()->take(random_int(1, 5))->pluck('id'));
        });
    }
}

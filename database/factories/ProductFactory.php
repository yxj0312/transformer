<?php

namespace Database\Factories;

use App\Models\Brand;
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
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'quantity' => $this->faker->randomNumber(),
            'image' => $this->faker->imageUrl,
            'is_featured' => $this->faker->boolean,
            'is_active' => true,
            'meta_title' => $this->faker->sentence,
            'meta_description' => $this->faker->paragraph,
            'slug' => $this->faker->slug,
            'featured_image' => $this->faker->imageUrl,
            'brand_id' => Brand::factory(),
            'category_id' => Category::factory(),
        ];
    }

    // public function configure()
    // {
    //     return $this->afterCreating(function (Product $product) {
    //         $product->categories()
    //             ->attach(Category::inRandomOrder()->take(random_int(1, 5))->pluck('id'));
    //     });
    // }
}

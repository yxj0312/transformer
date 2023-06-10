<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'slug' => $this->faker->slug,
            'description' => $this->faker->sentence,
            'image' => $this->faker->imageUrl,
            'parent_id' => null,
            'is_active' => true,
            'meta_title' => $this->faker->sentence,
            'meta_description' => $this->faker->paragraph,
            'order' => $this->faker->randomNumber,
        ];
    }
}

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
        $faker = Faker::create();

        return [
            'name' => $faker->word,
            'slug' => $faker->slug,
            'description' => $faker->sentence,
            'image' => $faker->imageUrl,
            'parent_id' => null,
            'is_active' => true,
            'meta_title' => $faker->sentence,
            'meta_description' => $faker->paragraph,
            'order' => $faker->randomNumber,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
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
            'name' => $faker->company,
            'slug' => $faker->slug,
            'description' => $faker->paragraph,
            'logo' => $faker->imageUrl(),
            'is_active' => $faker->boolean,
            'country' => $faker->country,
            'founded_year' => $faker->numberBetween(1900, 2023),
            'email' => $faker->email,
            'phone' => $faker->phoneNumber,
            'website' => $faker->url,
        ];
    }
}

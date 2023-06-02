<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'name' => $this->faker->company,
            'slug' => $this->faker->slug,
            'description' => $this->faker->paragraph,
            'logo' => $this->faker->imageUrl(),
            'is_active' => $this->faker->boolean,
            'country' => $this->faker->country,
            'founded_year' => $this->faker->numberBetween(1900, 2023),
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'website' => $this->faker->url,
        ];
    }
}

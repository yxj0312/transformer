<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name,
            'email' => fake()->unique()->safeEmail,
            'password' => bcrypt('password'), // Note: This is a sample password. You can generate a secure password using Faker as well.
            'role_id' => Role::factory(), // Set the role ID according to your needs
            'remember_token' => Str::random(10),
            'first_name' => fake()->firstName,
            'last_name' => fake()->lastName,
            'phone' => fake()->phoneNumber,
            'date_of_birth' => fake()->date,
            'is_verified' => false,
            'verification_token' => Str::random(60),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

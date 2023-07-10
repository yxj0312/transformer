<?php

namespace Database\Factories;

use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Role>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
       $roles = [
            Role::ROLE_ADMIN => [
                'slug' => 'admin',
                'description' => 'Administrator role',
                'is_default' => true,
            ],
            Role::ROLE_CUSTOMER => [
                'slug' => 'customer',
                'description' => 'Customer role',
                'is_default' => false,
            ],
            Role::ROLE_VENDOR => [
                'slug' => 'vendor',
                'description' => 'Vendor role',
                'is_default' => false,
            ],
        ];

        $roleName = $this->faker->randomElement(array_keys($roles));
        $roleData = $roles[$roleName];

        return [
            'name' => $roleName,
            'slug' => $roleData['slug'],
            'description' => $roleData['description'],
            'is_default' => $roleData['is_default'],
        ];
    }
}

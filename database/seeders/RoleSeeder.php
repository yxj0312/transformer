<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'Admin',
                'slug' => Role::ROLE_ADMIN,
                'description' => 'Administrator role',
                'is_default' => true,
            ],
            [
                'name' => 'Customer',
                'slug' => Role::ROLE_CUSTOMER,
                'description' => 'Customer role',
                'is_default' => false,
            ],
            [
                'name' => 'Vendor',
                'slug' => Role::ROLE_VENDOR,
                'description' => 'Vendor role',
                'is_default' => false,
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}

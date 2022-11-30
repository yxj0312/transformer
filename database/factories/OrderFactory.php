<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => null,
            'billing_email' => 'email@email.com',
            'billing_name' => 'Fake Order',
            'billing_address' => 'Fake Address',
            'billing_city' => 'Fake City',
            'billing_province' => 'Fake Province',
            'billing_postalcode' => 'L5B4U2',
            'billing_phone' => '9052145636',
            'billing_name_on_card' => 'Fake Name on Card',
            'billing_discount' => 0,
            'billing_discount_code' => null,
            'billing_subtotal' => 12345,
            'billing_tax' => 1605,
            'billing_total' => 13950,
            'error' => null,
        ];
    }
}

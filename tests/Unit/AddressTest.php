<?php

namespace Tests\Unit;

use App\Models\Address;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_address()
    {
        $user = User::factory()->create();

        $addressData = [
            'user_id' => $user->id,
            'address' => '123 Main St',
            'city' => 'New York',
            'state' => 'NY',
            'country' => 'USA',
            'postal_code' => '10001',
            'phone_number' => '12345678',
        ];

        $address = Address::create($addressData);

        $this->assertInstanceOf(Address::class, $address);
        $this->assertDatabaseHas('addresses', $addressData);
    }

    public function test_update_address()
    {
        $address = Address::factory()->create();

        $newData = [
            'address' => '456 Elm St',
            'city' => 'Los Angeles',
            'state' => 'CA',
            'country' => 'USA',
            'postal_code' => '90001',
        ];

        $address->update($newData);

        $this->assertDatabaseHas('addresses', $newData);
    }

    public function test_delete_address()
    {
        $address = Address::factory()->create();

        $address->delete();

        $this->assertSoftDeleted('addresses', ['id' => $address->id]);
    }

    public function test_belongs_to_user()
    {
        $user = User::factory()->create();
        $address = Address::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $address->user);
        $this->assertEquals($user->id, $address->user->id);
    }

    public function test_has_many_carts()
    {
        $address = Address::factory()->create();
       
        $cart1 = Cart::factory()->create(['shipping_address_id' => $address->id]);
        $cart2 = Cart::factory()->create(['billing_address_id' => $address->id]);
   
        $this->assertInstanceOf(Cart::class, $address->carts->first());
        $this->assertCount(2, $address->carts);
    }

    // Add any other tests here
}

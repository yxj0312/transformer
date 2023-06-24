<?php

namespace Tests\Unit;

use App\Models\Address;
use App\Models\Cart;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_user()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    /** @test */
    public function it_can_update_a_user()
    {
        $user = User::factory()->create();

        $updatedName = 'Updated Name';
        $user->name = $updatedName;
        $user->save();

        $this->assertEquals($updatedName, $user->fresh()->name);
    }

    /** @test */
    public function it_can_delete_a_user()
    {
        $user = User::factory()->create();

        $user->delete();

        $this->assertSoftDeleted('users', [
            'id' => $user->id,
        ]);
    }

    /** @test */
    public function it_belongs_to_a_role()
    {
        $role = Role::factory()->create();
        $user = User::factory()->create(['role_id' => $role->id]);

        $this->assertInstanceOf(Role::class, $user->role);
        $this->assertEquals($role->id, $user->role->id);
    }

    /** @test */
    public function it_has_many_addresses()
    {
        $user = User::factory()->create();
        Address::factory()->count(3)->create(['user_id' => $user->id]);

        $this->assertInstanceOf(Address::class, $user->addresses->first());
        $this->assertCount(3, $user->addresses);
    }

    /** @test */
    public function it_has_one_cart()
    {
        $user = User::factory()->create();
        $cart = Cart::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(Cart::class, $user->cart);
        $this->assertEquals($cart->id, $user->cart->id);
    }

    // /** @test */
    // public function it_has_many_orders()
    // {
    //     $user = User::factory()->create();
    //     $orders = Order::factory()->count(2)->create(['user_id' => $user->id]);

    //     $this->assertInstanceOf(Order::class, $user->orders->first());
    //     $this->assertCount(2, $user->orders);
    // }
}

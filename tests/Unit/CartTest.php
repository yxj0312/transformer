<?php

namespace Tests\Unit;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a cart.
     *
     * @return void
     */
    public function test_create_cart()
    {
        $user = User::factory()->create();

        $cart = Cart::create([
            'user_id' => $user->id,
            'session_id' => 'abc123',
        ]);

        $this->assertInstanceOf(Cart::class, $cart);
        $this->assertDatabaseHas('carts', ['id' => $cart->id]);
    }

    /**
     * Test adding a product to a cart.
     *
     * @return void
     */
    public function test_add_product_to_cart()
    {
        $cart = Cart::factory()->create();
        $product = Product::factory()->create();

        $cart->products()->attach($product->id, [
            'quantity' => 2,
        ]);

        $this->assertDatabaseHas('cart_product', [
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
    }

    /**
     * Test accessing the user associated with a cart.
     *
     * @return void
     */
    public function test_access_user_of_cart()
    {
        $user = User::factory()->create();
        $cart = Cart::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $cart->user);
        $this->assertEquals($user->id, $cart->user->id);
    }

    /**
     * Test accessing the products in a cart.
     *
     * @return void
     */
    public function test_access_products_of_cart()
    {
        $cart = Cart::factory()->create();
        $product1 = Product::factory()->create();
        $product2 = Product::factory()->create();

        $cart->products()->attach($product1->id, [
            'quantity' => 2,
            'price' => 10.99,
        ]);
        $cart->products()->attach($product2->id, [
            'quantity' => 1,
            'price' => 5.99,
        ]);

        $this->assertCount(2, $cart->products);
        $this->assertTrue($cart->products->contains($product1));
        $this->assertTrue($cart->products->contains($product2));
    }

    /**
     * Test accessing the shipping address of a cart.
     *
     * @return void
     */
    public function test_access_shipping_address_of_cart()
    {
        $cart = Cart::factory()->create();
        $shippingAddress = ShippingAddress::factory()->create([
            'cart_id' => $cart->id,
        ]);

        $this->assertInstanceOf(ShippingAddress::class, $cart->shippingAddress);
        $this->assertEquals($shippingAddress->id, $cart->shippingAddress->id);
    }

    /**
     * Test accessing the billing address of a cart.
     *
     * @return void
     */
    public function test_access_billing_address_of_cart()
    {
        $cart = Cart::factory()->create();
        $billingAddress = Address::factory()->create([
            'cart_id' => $cart->id,
        ]);

        $this->assertInstanceOf(Address::class, $cart->billingAddress);
        $this->assertEquals($billingAddress->id, $cart->billingAddress->id);
    }
}

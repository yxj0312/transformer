<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_order()
    {
        // Create a user
        $user = User::factory()->create();

        // Create a payment method
        $paymentMethod = PaymentMethod::factory()->create();

        // Create an order status
        $orderStatus = OrderStatus::factory()->create();

        // Create an order
        $order = Order::create([
            'user_id' => $user->id,
            'payment_method_id' => $paymentMethod->id,
            'order_status_id' => $orderStatus->id,
            'total_amount' => 100.00,
            'currency' => 'USD',
            'payment_status' => 'paid',
            'shipping_method' => 'express',
            'shipping_address' => '123 Shipping St, City, Country',
            'billing_address' => '456 Billing St, City, Country',
        ]);

        // Assert the order has been created
        $this->assertInstanceOf(Order::class, $order);
        $this->assertEquals($user->id, $order->user_id);
        $this->assertEquals($paymentMethod->id, $order->payment_method_id);
        $this->assertEquals($orderStatus->id, $order->order_status_id);
        $this->assertEquals(100.00, $order->total_amount);
        $this->assertEquals('USD', $order->currency);
        $this->assertEquals('paid', $order->payment_status);
        $this->assertEquals('express', $order->shipping_method);
        $this->assertEquals('123 Shipping St, City, Country', $order->shipping_address);
        $this->assertEquals('456 Billing St, City, Country', $order->billing_address);
    }

    public function test_update_order()
    {
        // Create an order
        $order = Order::factory()->create();

        // Update the order
        $order->update([
            'total_amount' => 200.00,
            'currency' => 'EUR',
            'payment_status' => 'failed',
            'shipping_method' => 'standard',
            'tracking_number' => '123456',
            'shipping_address' => '123 Shipping St, City, Country',
            'billing_address' => '456 Billing St, City, Country',
        ]);

        // Assert the order has been updated
        $this->assertEquals(200.00, $order->total_amount);
        $this->assertEquals('EUR', $order->currency);
        $this->assertEquals('failed', $order->payment_status);
        $this->assertEquals('standard', $order->shipping_method);
        $this->assertEquals('123456', $order->tracking_number);
        $this->assertEquals('123 Shipping St, City, Country', $order->shipping_address);
        $this->assertEquals('456 Billing St, City, Country', $order->billing_address);
    }

    public function test_delete_order()
    {
        // Create an order
        $order = Order::factory()->create();

        // Delete the order
        $order->delete();

        // Assert the order has been soft deleted
        $this->assertSoftDeleted($order);
    }

    public function test_order_user_relationship()
    {
        // Create an order and associate a user
        $order = Order::factory()->create();
        $user = User::factory()->create();
        // $order->user_id = $user->id;
        # or
        // $order->user()->associate($user);
        $order->user()->associate($user);

        // Assert the relationship between order and user
        $this->assertEquals($user->id, $order->user->id);
    }

    public function test_order_payment_method_relationship()
    {
        // Create an order and associate a payment method
        $order = Order::factory()->create();
        $paymentMethod = PaymentMethod::factory()->create();
        $order->paymentMethod()->associate($paymentMethod);

        // Assert the relationship between order and payment method
        $this->assertEquals($paymentMethod->id, $order->paymentMethod->id);
    }

    public function test_order_status_relationship()
    {
        // Create an order and associate an order status
        $order = Order::factory()->create();
        $orderStatus = OrderStatus::factory()->create();
        $order->orderStatus()->associate($orderStatus);

        // Assert the relationship between order and order status
        $this->assertEquals($orderStatus->id, $order->orderStatus->id);
    }

    public function test_order_products_relationship()
    {
        // Create an order
        $order = Order::factory()->create();

        // Create multiple products and associate them with the order
        $products = Product::factory()->count(3)->create();
        $order->products()->attach($products, ['quantity' => 1]);

        // Assert the relationship between order and products
        $this->assertCount(3, $order->products);
    }
}

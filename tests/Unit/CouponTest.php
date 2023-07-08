<?php

namespace Tests\Unit;

use App\Models\Coupon;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class CouponTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test_can_create_coupon
     */
    public function test_can_create_coupon()
    {
        $product = Product::factory()->create();

        $couponData = [
            'code' => 'TESTCOUPON',
            'discount_amount' => 10,
            'discount_type' => Coupon::DISCOUNT_TYPE_FIXED,
            'couponable_id' => $product->id,
            'couponable_type' => Product::class,
        ];

        $coupon = Coupon::create($couponData);

        $this->assertInstanceOf(Coupon::class, $coupon);
        $this->assertDatabaseHas('coupons', $couponData);
        $this->assertEquals($couponData['code'], $coupon->code);
        $this->assertEquals($couponData['discount_amount'], $coupon->discount_amount);
        $this->assertEquals($couponData['discount_type'], $coupon->discount_type);
        $this->assertEquals($product->id, $coupon->couponable->id);
        $this->assertInstanceOf(Product::class, $coupon->couponable);
        $this->assertEquals($product->name, $coupon->couponable->name);
        $this->assertEquals($product->slug, $coupon->couponable->slug);
    }

    /**
     * test_can_update_coupon
     */
    public function test_can_update_coupon()
    {
        $product = Product::factory()->create();

        $coupon = Coupon::factory()->create([
            'couponable_id' => $product->id,
            'couponable_type' => Product::class,
        ]);

        $this->assertInstanceOf(Coupon::class, $coupon);
        $this->assertInstanceOf(Product::class, $coupon->couponable);
        $this->assertEquals($product->name, $coupon->couponable->name);
        $this->assertEquals($product->slug, $coupon->couponable->slug);

        $order = Order::factory()->create();
        
        $updatedData = [
            'code' => 'UPDATEDCODE',
            'discount_amount' => 20,
            'discount_type' => Coupon::DISCOUNT_TYPE_PERCENTAGE,
            'couponable_id' => $order->id,
            'couponable_type' => Order::class,
        ];

        $coupon->update($updatedData);
        $coupon->refresh();

        $this->assertEquals($updatedData['code'], $coupon->code);
        $this->assertEquals($updatedData['discount_amount'], $coupon->discount_amount);
        $this->assertEquals($updatedData['discount_type'], $coupon->discount_type);
        $this->assertEquals($updatedData['couponable_id'], $coupon->couponable->id);
        $this->assertInstanceOf(Order::class, $coupon->couponable);
        $this->assertEquals($order->name, $coupon->couponable->name);
        $this->assertEquals($order->slug, $coupon->couponable->slug);
        $this->assertEquals($order->id, $coupon->couponable->id);
    }

    /**
     * test_can_soft_delete_coupon
     */
    public function test_can_soft_delete_coupon()
    {
        $product = Product::factory()->create();

        $coupon = Coupon::factory()->create();

        $coupon->delete();

        $this->assertSoftDeleted('coupons', ['id' => $coupon->id]);
    }

    /*
    * test_can_get_couponable
    */
    public function test_can_get_couponable()
    {
        $product = Product::factory()->create();

        $coupon = Coupon::factory()->create([
            'couponable_id' => $product->id,
            'couponable_type' => Product::class,
        ]);

        $this->assertInstanceOf(Product::class, $coupon->couponable);
        $this->assertEquals($product->name, $coupon->couponable->name);
        $this->assertEquals($product->slug, $coupon->couponable->slug);
    }

    /*
    * test_can_get_couponable_with_trashed
    */
    public function test_can_get_couponable_with_trashed()
    {
        $product = Product::factory()->create();

        $coupon = Coupon::factory()->create([
            'couponable_id' => $product->id,
            'couponable_type' => Product::class,
        ]);

        $product->delete();

        $this->assertInstanceOf(Product::class, $coupon->couponable()->withTrashed()->first());
        $this->assertEquals($product->name, $coupon->couponable()->withTrashed()->first()->name);
        $this->assertEquals($product->slug, $coupon->couponable()->withTrashed()->first()->slug);
    }
}

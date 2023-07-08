<?php

namespace Tests\Unit;

use App\Models\Coupon;
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
}

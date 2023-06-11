<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use RefreshDatabase;

    public function test_review_belongs_to_product()
    {
        $product = Product::factory()->create();
        $review = Review::factory()->create(['product_id' => $product->id]);

        $this->assertInstanceOf(Product::class, $review->product);
        $this->assertEquals($product->id, $review->product->id);
    }

    public function test_review_belongs_to_user()
    {
        $user = User::factory()->create();
        $review = Review::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $review->user);
        $this->assertEquals($user->id, $review->user->id);
    }
}

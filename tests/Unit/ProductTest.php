<?php

namespace Tests\Unit;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Collection;
use Tests\TestCase;


class ProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a product.
     *
     * @return void
     */
    public function test_create_product()
    {

        $product = Product::create([
            'name' => 'Sample Product',
            'description' => 'This is a sample product.',
            'price' => 9.99,
            'quantity' => 10,
            'image' => 'sample.jpg',
            'is_featured' => true,
            'is_active' => true,
            'meta_title' => 'Sample Product',
            'meta_description' => 'Sample product meta description.',
            'slug' => 'sample-product',
            'featured_image' => 'sample_featured.jpg',
            'brand_id' => Brand::factory()->create()->id,
            'category_id' => Category::factory()->create()->id,
        ]);

        // Assert the product was created
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Sample Product',
            'description' => 'This is a sample product.',
            'price' => 9.99,
            'quantity' => 10,
            'image' => 'sample.jpg',
            'is_featured' => true,
            'is_active' => true,
            'meta_title' => 'Sample Product',
            'meta_description' => 'Sample product meta description.',
            'slug' => 'sample-product',
            'featured_image' => 'sample_featured.jpg',
            'brand_id' => 1,
            'category_id' => 1,
        ]);
    }

    /**
     * Test updating a product.
     *
     * @return void
     */
    public function test_update_product()
    {
        $product = Product::factory()->create();

        $updatedProductData = [
            'name' => 'Updated Product',
            'description' => 'This is an updated product.',
            'price' => 19.99,
            'quantity' => 5,
            'image' => 'updated.jpg',
            'is_featured' => false,
            'is_active' => true,
            'meta_title' => 'Updated Product',
            'meta_description' => 'Updated product meta description.',
            'slug' => 'updated-product',
            'featured_image' => 'updated_featured.jpg',
        ];

        // Update the category
        $product->update($updatedProductData);

        // Assert the product was update
        $this->assertDatabaseHas('products', $updatedProductData);
    }

    /**
     * Test deleting a product.
     *
     * @return void
     */
    public function test_delete_product()
    {
        $product = Product::factory()->create();

        $product->delete();

        $this->assertSoftDeleted('products', [
            'id' => $product->id,
        ]);
    }

    /**
     * Test the brand relationship of a product.
     *
     * @return void
     */
    public function test_product_brand_relationship()
    {
        // Create a brand
        $brand = Brand::factory()->create();

        // Create a product and assign the brand
        $product = Product::factory()->create([
            'brand_id' => $brand->id,
        ]);

        // Assert the correctness of the product's brand relationship
        $this->assertInstanceOf(Brand::class, $product->brand);
        $this->assertEquals($brand->id, $product->brand->id);
    }

    /**
     * Test the category relationship of a product.
     *
     * @return void
     */
    public function test_product_category_relationship()
    {
        // Create a category
        $category = Category::factory()->create();

        // Create a product and assign the category
        $product = Product::factory()->create([
            'category_id' => $category->id,
        ]);

        // Assert the correctness of the product's category relationship
        $this->assertInstanceOf(Category::class, $product->category);
        $this->assertEquals($category->id, $product->category->id);
    }

    /**
     * Test the orders relationship of a product.
     *
     * @return void
     */
    public function test_product_orders_relationship()
    {
        // Create a product
        $product = Product::factory()->create();

        // Create an order
        $order = Order::factory()->create();

        // Attach the product to the order
        $order->products()->attach($product->id, [
            'quantity' => 1,
            'price' => $product->price,
        ]);

        // Assert the correctness of the product's orders relationship
        $this->assertInstanceOf(Collection::class, $product->orders);
        $this->assertInstanceOf(Order::class, $product->orders->first());
        $this->assertEquals($order->id, $product->orders->first()->id);
    }
}

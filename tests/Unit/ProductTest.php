<?php

namespace Tests\Unit;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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

        $product = Product::factory()->create([
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
            'brand_id' => Brand::factory(),
            'category_id' => Category::factory(),
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
            'brand_id' => 2,
            'category_id' => 2,
        ];

        $response = $this->putJson('/api/products/' . $product->id, $updatedProductData);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Product updated successfully.',
            ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Updated Product',
        ]);
    }

    /**
     * Test deleting a product.
     *
     * @return void
     */
    public function testDeleteProduct()
    {
        $product = Product::factory()->create();

        $response = $this->delete('/api/products/' . $product->id);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Product deleted successfully.',
            ]);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    /**
     * Test the brand relationship of a product.
     *
     * @return void
     */
    public function testProductBrandRelationship()
    {
        // 创建一个品牌
        $brand = Brand::factory()->create();

        // 创建一个产品并分配品牌
        $product = Product::factory()->create([
            'brand_id' => $brand->id,
        ]);

        // 断言产品的品牌关联关系是否正确
        $this->assertInstanceOf(Brand::class, $product->brand);
        $this->assertEquals($brand->id, $product->brand->id);
    }

    /**
     * Test the category relationship of a product.
     *
     * @return void
     */
    public function testProductCategoryRelationship()
    {
        // 创建一个分类
        $category = Category::factory()->create();

        // 创建一个产品并分配分类
        $product = Product::factory()->create([
            'category_id' => $category->id,
        ]);

        // 断言产品的分类关联关系是否正确
        $this->assertInstanceOf(Category::class, $product->category);
        $this->assertEquals($category->id, $product->category->id);
    }
}

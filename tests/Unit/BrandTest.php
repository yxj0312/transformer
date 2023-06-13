<?php

namespace Tests\Unit;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrandTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_brand()
    {
        $brandData = [
            'name' => 'Example Brand',
            'slug' => 'example-brand',
            'description' => 'This is an example brand',
            'logo' => 'example-logo.png',
            'is_active' => true,
            'country' => 'United States',
            'founded_year' => 1990,
            'email' => 'example@example.com',
            'phone' => '1234567890',
            'website' => 'https://example.com',
        ];

        $brand = Brand::create($brandData);

        $this->assertInstanceOf(Brand::class, $brand);
        $this->assertDatabaseHas('brands', $brandData);
    }

    public function test_can_update_brand()
    {
        $brand = Brand::factory()->create();

        $updatedData = [
            'name' => 'Updated Name',
            'description' => 'Updated description',
            // Add other fields to update
        ];

        $brand->update($updatedData);

        $this->assertEquals($updatedData['name'], $brand->name);
        $this->assertEquals($updatedData['description'], $brand->description);
        // Add more assertions for updated fields
    }

    public function test_can_soft_delete_brand()
    {
        $brand = Brand::factory()->create();

        $brand->delete();

        $this->assertSoftDeleted('brands', ['id' => $brand->id]);
    }


    public function test_brand_has_products_relationship()
    {
        $brand = Brand::factory()->create();

        $product = Product::factory()->create(['brand_id' => $brand->id]);

        $this->assertTrue($brand->products->contains($product));
    }

    // Add more tests for other brand relationships
}

<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test creating a new category.
     *
     * @return void
     */
    public function testCreateCategory()
    {
        // Create a new category
        $category = Category::factory()->create([
            'name' => 'Test Category',
            'slug' => 'test-category',
            'description' => 'This is a test category',
            'image' => 'category.jpg',
            'is_active' => true,
            'meta_title' => 'Test Category Meta Title',
            'meta_description' => 'Test Category Meta Description',
            'order' => 1,
        ]);

        // Assert the category was created
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Test Category',
            'slug' => 'test-category',
            'description' => 'This is a test category',
            'image' => 'category.jpg',
            'is_active' => true,
            'meta_title' => 'Test Category Meta Title',
            'meta_description' => 'Test Category Meta Description',
            'order' => 1,
        ]);
    }

    /**
     * Test updating a category.
     *
     * @return void
     */
    public function testUpdateCategory()
    {
        // Create a category
        $category = Category::factory()->create();

        // Update the category
        $category->update([
            'name' => 'Updated Category',
            'description' => 'This is an updated category',
        ]);

        // Assert the category was updated
        $this->assertEquals('Updated Category', $category->name);
        $this->assertEquals('This is an updated category', $category->description);
    }

    /**
     * Test deleting a category.
     *
     * @return void
     */
    public function testDeleteCategory()
    {
        // Create a category
        $category = Category::factory()->create();

        // Delete the category
        $category->delete();

        // Assert the category was deleted
        $this->assertSoftDeleted('categories', ['id' => $category->id]);
    }

    /**
     * Test retrieving the parent category.
     *
     * @return void
     */
    public function testRetrieveParentCategory()
    {
        // Create a parent category
        $parentCategory = Category::factory()->create();

        // Create a child category
        $childCategory = Category::factory()->create([
            'parent_id' => $parentCategory->id,
        ]);

        // Retrieve the parent category
        $parent = $childCategory->parent;

        // Assert the parent category is correct
        $this->assertEquals($parentCategory->id, $parent->id);
    }

    /**
     * Test retrieving the child categories.
     *
     * @return void
     */
    public function testRetrieveChildCategories()
    {
        // Create a parent category
        $parentCategory = Category::factory()->create();

        // Create child categories
        $childCategory1 = Category::factory()->create([
            'parent_id' => $parentCategory->id,
        ]);
        $childCategory2 = Category::factory()->create([
            'parent_id' => $parentCategory->id,
        ]);

        // Retrieve the child categories
        $children = $parentCategory->children;

        // Assert the child categories are correct
        $this->assertCount(2, $children);
        $this->assertEquals($childCategory1->id, $children[0]->id);
        $this->assertEquals($childCategory2->id, $children[1]->id);
    }

    /**
     * Test retrieving the products under the category.
     *
     * @return void
     */
    public function testRetrieveCategoryProducts()
    {
        // Create a category
    $category = Category::factory()->create();

    // Create products using the ProductFactory
    $product1 = Product::factory()->create([
        'category_id' => $category->id,
        'name' => 'Product 1',
        'description' => 'Product 1 description',
        'price' => 10.99,
    ]);

    $product2 = Product::factory()->create([
        'category_id' => $category->id,
        'name' => 'Product 2',
        'description' => 'Product 2 description',
        'price' => 19.99,
    ]);

    // Retrieve the products under the category
    $products = $category->products;

    // Assert the products are correct
    $this->assertCount(2, $products);
    $this->assertEquals($product1->id, $products[0]->id);
    $this->assertEquals($product2->id, $products[1]->id);
    $this->assertEquals('Product 1 description', $products[0]->description);
    $this->assertEquals('Product 2 description', $products[1]->description);
    }
}

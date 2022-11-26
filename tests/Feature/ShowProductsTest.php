<?php

namespace Tests\Feature;

use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ShowProductsTest extends TestCase
{
    use RefreshDatabase;

    
    /** @test */
    function list_of_products_shows_on_main_page()
    {
        $productOne = Product::factory()->create([
            'name' => 'My First Product Name',
            'description' => 'Descrption of my first product'
        ]);

        $productTwo = Product::factory()->create([
            'name' => 'My Second Product Name',
            'description' => 'Descrption of my second product'
        ]);

        $response = $this->get(route('product.index'));

        $response->assertSuccessful();
        $response->assertSee($productOne->name);
        $response->assertSee($productOne->description);
        $response->assertSee($productTwo->name);
        $response->assertSee($productTwo->description);
    }

    /** @test */
    function test_showing_products_api()
    {
        $product = Product::factory()->create();
        $response = $this->getJson(route('products.index'));
        $response
            ->assertJson(fn (AssertableJson $json) =>
            $json->has('data', 1, fn ($json) =>  
                $json->where('id', 1)
                     ->where('name', $product->name)
                     ->where('slug', $product->slug)
                     ->where('description', $product->description)
                     ->where('categories', $product->categories)
                ->etc()
                )->etc()
        );
    } 

    /** @test */
    function it_returns_the_products_with_the_categories()
    {
        $categories = Category::factory()->count(3)->create();
        $products = Product::factory()->count(3)->create()->each(function ($product) use($categories){
            $product->categories()->attach($categories);
        });
        // dd($categories->first()->pluck('id'));
        $response = $this->getJson(route('products.index'));
        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('data', 3, fn ($json) =>
                $json->where('id', 1)
                    ->where('name', $products->first()->name)
                    ->has('categories')
                ->etc()
            )->etc()
        );
    }
}

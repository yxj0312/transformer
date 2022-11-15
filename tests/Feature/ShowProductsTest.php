<?php

namespace Tests\Feature;

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
        $this->withoutExceptionHandling();
        $product = Product::factory()->create();

        $response = $this->getJson(route('products.index'));

        // $response->assertStatus(200)
        //     ->assertJson([
        //         [
        //             'id' => 1,
        //             'name' => $product->name,
        //             'slug'=> NULL,
        //             'description' => $product->description,
        //         ]
        //     ]);

        $response
            ->assertJson(fn (AssertableJson $json) =>
            $json->has(1)
                ->first(fn ($json) =>
                    $json->where('id', 1)
                        ->where('name', $product->name)
                        ->where('description', $product->description)
                        ->etc()
                )
        );
    } 

    /** @test */
    function it_returns_the_products_with_the_categories()
    {
        $categories = Category::factory()->count(3)->create();
        // dd($categories->toArray());
        $products = Product::factory()->count(3)->create()->each(function ($product) use($categories){
            $product->categories()->attach($categories);
        });

        dd($categories->pluck('id'));

        $response = $this->getJson(route('products.index'));

        $response->assertJson(fn (AssertableJson $json) =>
        $json->has(1)
                ->first(fn ($json) =>
                    $json->where('id', 1)
                        ->where('name', $products->first()->name)
                        ->where('description', $products->first()->description)
                        ->where('categories', $categories->pluck('id'))
                        ->etc()
                )

        );
        // dd($products->toArray());
    }
}

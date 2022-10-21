<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
    
}

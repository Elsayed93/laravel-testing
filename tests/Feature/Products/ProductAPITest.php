<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductAPITest extends TestCase
{

    use RefreshDatabase;
    public function test_list_products_api()
    {
        $product = Product::factory()->create(); // arrange 

        $response = $this->getJson('api/products'); // act

        $response->assertStatus(200)->assertJson([$product->toArray()]); //assert
    }


    public function test_store_product_successfully()
    {
        $product = [
            "name" => "test product name from post man",
            "description" => "test product description from post man",
            "price" => "135"
        ];

        $response = $this->postJson('api/products', $product);

        $response->assertStatus(201);
        $response->assertJson($product);
    }


    public function test_store_product_failed()
    {
        $product = [
            // "name" => "test product name from post man",
            "name" => "",
            "description" => "test product description from post man",
            "price" => "135"
        ];

        $response = $this->postJson('api/products', $product);

        $response->assertStatus(422);
        // $response->assertJson($product);
    }
}

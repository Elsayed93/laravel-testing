<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Product;
use Tests\TestCase;

class IndexTest extends TestCase
{

    use RefreshDatabase;

    public function test_empty_products_table()
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertSee('No Products Found ...');
    }

    public function test_none_empty_products_table()
    {

        $product =  Product::create([
            'name' => 'test product1',
            'price' => 123,
            'description' => 'test product1 description',
        ]);
        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertDontSee('No Products Found ...');
        $response->assertSee('test product1');
        $response->assertViewHas('products', function ($collection) use ($product) {
            return $collection->contains($product);
        });
    }
}

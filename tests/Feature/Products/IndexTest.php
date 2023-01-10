<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_products_list_page_return_a_successful_response()
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
    }

    public function test_the_products_list_page_empty_table()
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertSee('No Products Found ...');
    }

}

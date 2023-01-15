<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Product;
use App\Models\User;
use Tests\TestCase;

class ProductsTest extends TestCase
{

    use RefreshDatabase;

    private $user;
    private $admin;

    public function setUp(): void
    {

        parent::setUp();
        $this->user = $this->createUser();
        $this->admin = $this->createUser(isAdmin: true);
    }


    private function createUser(bool $isAdmin = false)
    {
        return User::factory()->create([
            'is_admin' => $isAdmin
        ]);
    }


    public function test_un_authenticate_user_can_not_access_products_page()
    {
        $response = $this->get('products');

        $response->assertStatus(302);
        $response->assertRedirect('login');
    }


    public function test_empty_products_table()
    {
        $response = $this->actingAs($this->user)->get('products');
        // $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertSee('No Products Found ...');
    }

    public function test_none_empty_products_table()
    {

        $products =  Product::factory(11)->create();
        $lastProduct = $products->last();

        $response =  $this->actingAs($this->user)->get('/products');
        // $response = $this->get('/products');

        $response->assertStatus(200);
        $response->assertDontSee('No Products Found ...');

        $response->assertViewHas('products', function ($collection) use ($lastProduct) {
            return !$collection->contains($lastProduct);
        });
    }


    public function test_admin_can_see_add_button()
    {
        $response = $this->actingAs($this->admin)->get('products');

        $response->assertSee('Add Product');
        $response->assertStatus(200);
    }


    public function test_non_admin_can_not_see_add_button()
    {

        $response = $this->actingAs($this->user)->get('products');

        $response->assertDontSee('Add Product');
        $response->assertStatus(200);
    }


    public function test_admin_can_go_to_create_page()
    {
        $response = $this->actingAs($this->admin)->get('products/create');

        $response->assertSee('Create Product');
        $response->assertStatus(200);
    }

    public function test_non_admin_can_not_go_to_create_page()
    {

        $response = $this->actingAs($this->user)->get('products/create');

        $response->assertDontSee('create page');
        $response->assertStatus(403);
    }



    public function test_store_product_in_database()
    {
        $product = [
            'name' => 'test product from testing',
            'price' => 300,
            'description' => 'test product description from testing',
        ];

        $tableRowsCount = Product::count();
        $response = $this->actingAs($this->admin)->post('products', $product); // store product

        $lastProduct = Product::orderBy('id', 'DESC')->first();

        $this->assertEquals($lastProduct->name, $product['name']);
        $this->assertEquals($lastProduct->price, $product['price']);
        $this->assertEquals($lastProduct->description, $product['description']);

        $this->assertDatabaseCount('products', $tableRowsCount + 1);
        $this->assertDatabaseHas('products', $product);

        $response->assertStatus(302);
        $response->assertRedirect('products');
    }



    public function test_admin_can_see_edit_button()
    {
        $response = $this->actingAs($this->admin)->get('products');

        $response->assertSee('Edit');
        $response->assertStatus(200);

    }

    public function test_non_admin_can_not_see_edit_button()
    {
        $response = $this->actingAs($this->user)->get('products');

        $response->assertDontSee('Edit');
        $response->assertStatus(200);

    }


    // public function test_admin_can_go_to_edit_page()
    // {
    //     # code...
    // $response = $this->get('products/1/edit');
    // $response->assertStatus(200);
    // $response->assertSee('Edit Product');
    // }

    // public function test_update_product_in_database()
    // {
    //     $product = [
    //         'name' => 'test product from testing',
    //         'price' => 300,
    //         'description' => 'test product description from testing',
    //     ];

    //     $tableRowsCount = Product::count();
    //     $response = $this->actingAs($this->admin)->post('products', $product); // store product

    //     $lastProduct = Product::orderBy('id', 'DESC')->first();

    //     $this->assertEquals($lastProduct->name, $product['name']);
    //     $this->assertEquals($lastProduct->price, $product['price']);
    //     $this->assertEquals($lastProduct->description, $product['description']);

    //     $this->assertDatabaseCount('products', $tableRowsCount + 1);
    //     $this->assertDatabaseHas('products', $product);

    //     $response->assertStatus(302);
    //     $response->assertRedirect('products');
    // }
}

<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductsApiTest extends TestCase
{

    use RefreshDatabase;
    public function testCanGetAllProducts(): void
    {
        // Create Property so that the response returns it.
        $product = Product::factory()->create();

        $response = $this->getJson(route('api.products'));
        // We will only assert that the response returns a 200 status for now.
        $response->assertOk();

        $response->assertJson([
            "status"=> true,
            "message"=> "Success",
            'data' => [
                [
                    'id' => $product->id,
                    'title' => $product->title,
                    'price' => $product->price,
                    'old_price' => $product->old_price,
                    'available' => $product->available,
                    'image' => $product->image,
                    'category_id' => $product->category_id,
                ]
            ]
        ]);
    }
}

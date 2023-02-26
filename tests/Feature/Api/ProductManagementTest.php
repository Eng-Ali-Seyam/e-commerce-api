<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductManagementTest extends TestCase
{
    use RefreshDatabase;

    public function testCanGetAllProducts(): void
    {
        $product = Product::factory()->create();
        $response = $this->getJson(route('api.products'));
        $response->assertOk();
        $response->assertJson([
            "status" => true,
            "message" => "Success",
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

    public function testCanCreateProduct()
    {

        $this->withoutExceptionHandling();
        $category = Category::factory()->create();

        $response = $this->post(route('api.products.store'), [
            'title' => 'title',
            'price' => 150,
            'old_price' => 160,
            'available' => true,
            'image' => 'https://img.ltwebstatic.com/images3_pi/2022/05/06/165180795441c853c60fac733d3e1f4ecf4e9e76ea_thumbnail_405x552.webp',
            'category_id' => $category->id,
        ]);
        $response->assertCreated();
        $response->assertJsonStructure([
            "success",
            "message",
            "data"
        ]);

    }

    public function testCanShowExistProduct()
    {
        $product = Product::factory()->create();
        $response = $this->get(route('api.products.show', $product->id));
        $response->assertOk();
        $response->assertJsonStructure(
            [
                "success",
                "message",
                "data"
            ]
        );
    }

    public function testCanNotShowNotExistProduct()
    {
        $response = $this->get(route('api.products.show', 5));
        $response->assertNotFound();
        $response->assertJson(
            [
                'success' => false,
                'message' => 'Product Not Found',
            ]
        );
    }

    public function testCanDeleteExistProduct()
    {
        $this->withoutExceptionHandling();
        $product = Product::factory()->create();
        $response = $this->delete(route('api.products.delete', $product));
        $response->assertOk();
        $response->assertJsonStructure(
            [
                "success",
                "message",
                "data"
            ]
        );
    }

    public function testCanUpdateExistProduct()
    {

        $this->withoutExceptionHandling();
        $category = Category::factory()->create();
        $product = Product::factory()->create();
        $response = $this->put(route('api.products.update',$product), [
            'title' => 'title',
            'price' => 150,
            'old_price' => 160,
            'available' => true,
            'image' => 'https://img.ltwebstatic.com/images3_pi/2022/05/06/165180795441c853c60fac733d3e1f4ecf4e9e76ea_thumbnail_405x552.webp',
            'category_id' => $category->id,
        ]);
        $response->assertOk();
        $response->assertJsonStructure([
            "success",
            "message",
            "data"
        ]);
    }

}

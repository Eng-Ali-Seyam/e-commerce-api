<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductsTest extends TestCase
{
    use RefreshDatabase;
    public function testCategoryHasAPath()
    {

        $product = Product::factory()->create();
        $path = $product->path();
        $this->assertEquals('products/'.$product->id,$path);
    }

    public function testProductsBelongToCategory()
    {
        $product = Product::factory()->create();
        $this->assertInstanceOf(Category::class,$product->category);
    }

    public function testProductCanBeAvailable()
    {
        $product = Product::factory()->create();

        $this->assertTrue($product->available);

    }

    public function testProductChangeToNonAvailable()
    {
        $product = Product::factory()->create();
        $this->assertTrue($product->available);
        $product->available = false;
        $product->save();
        $this->assertFalse($product->available);
    }
}

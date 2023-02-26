<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriesTest extends TestCase
{

    use RefreshDatabase;
    public function testCategoryHasAPath()
    {

        $category = Category::factory()->create();
        $path = $category->path();
        $this->assertEquals('categories/'.$category->id,$path);
    }

    public function testCategoriesHasProducts(){

        $this->withoutExceptionHandling();

        $category = Category::factory()->create();
        $product =Product::factory()->create(['category_id'=> $category->id]);

        $this->assertTrue($category->products->contains($product));

        $this->assertEquals(1, $category->products->count());

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $category->products);
    }
}

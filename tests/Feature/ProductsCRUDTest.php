<?php

namespace Tests\Feature;

use App\Models\Category;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductsCRUDTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase ;



    public function  testRedirectToProductsPageWhenCreateProduct(){
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('products',$this->data());
        $response->assertRedirect(route('products.index'));
        $this->get('products')->assertSeeText($this->data()['title'],false);
    }

    public function testRedirectedToLoginIfNotAuthenticatedWith302Status(){

        $response = $this->post('products',$this->data());
        $response->assertStatus(302);
        $response->assertRedirect('login');
    }


    public function testCountOfDatabaseCategoriesTableIs1()
    {
        $user = User::factory()->create();
        $this->actingAs($user)->post('products',$this->data());
        $this->assertDatabaseCount('products',1);
    }

    public function testCanUpdatingProduct()
    {
        $user = User::factory()->create();
        $this->withoutExceptionHandling();
        $product = Product::factory()->create();
        $response =$this->actingAs($user)->put(route('products.update',$product),$this->data(['title','changed title']));
        $response->assertOk();
    }

    public function testCanDeleteProduct()
    {
        $user = User::factory()->create();
        $this->withoutExceptionHandling();
        $product = Product::factory()->create();
        $this->assertDatabaseCount('products',1);
        $response =$this->actingAs($user)->delete(route('products.delete',$product));
        $response->assertOk();
        $this->assertDatabaseCount('products',0);
    }

    private function data($data =[]){

        $category = Category::factory()->create();

        $default = [
            'title'  => 'shirt' ,
            'price'  => '250' ,
            'old_price'  => '260' ,
            'image'  => 'ht tps://design-zentrum-hamburg.de/site/assets/files/3194/keyvisuals_ffp16-v1.jpg' ,
            'available'  => true ,
            'category_id'  => $category->id ,
           ];

        return array_merge($default,$data);
    }
}

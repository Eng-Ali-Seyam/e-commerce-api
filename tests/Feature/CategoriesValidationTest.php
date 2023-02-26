<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoriesValidationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    use RefreshDatabase ;
    public  function testCanNotCreateCategoryWithEmptyName(){
        $user =User::factory()->create();
        $user->role ='admin';
        $response = $this->actingAs($user)->post('/categories',$this->data(['name'=>'']));
        $response->assertSessionHasErrors( ['name' => 'name is required']);

    }
    public  function testCanNotCreateCategoryWithEmptyImage(){
        $user =User::factory()->create();
        $user->role ='admin';

        $response = $this->actingAs($user)->post('/categories',$this->data(['image'=>'']));

        $response->assertSessionHasErrors( ['image' => 'image is required']);

    }




    private function data($data =[]){

        $default = [
            'name'  => 'watch' ,
            'image' => 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.vector4free.com%2Ffree-vectors%2FWatch&psig=AOvVaw2jSFz1QBSoFWaRrv_OEWf2&ust=1675798994549000&source=images&cd=vfe&ved=0CA8QjRxqFwoTCIjNve_Tgf0CFQAAAAAdAAAAABAE'
        ];

        return array_merge($default,$data);
    }

}

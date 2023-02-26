<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminRegisterTest extends TestCase
{

    use  RefreshDatabase ;
    public function testAAdminCanRegister()
    {
        $admin =  [
            'name' => 'Joe',
            'email' => 'testemail@test.com',
            'password' => 'passwordtest',
            'password_confirmation' => 'passwordtest'
        ];
        $response = $this->post(route('register'), $admin);
        $response->assertRedirect('/home');
        $this->assertDatabaseCount('admins', 1);

    }
}

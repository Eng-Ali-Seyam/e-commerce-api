<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class RegisterApiTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        \Artisan::call('passport:install');
    }

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */


    public function testAUserCanRegister()
    {
        Passport::$hashesClientSecrets = false;
        $this->withoutExceptionHandling();
        $response = $this->post(route('api.register'),[
            'name' => "Ali Siam",
            'email' => 'k99@gg.com',
            'password' => 'secret123',
            'password_confirmation' => 'secret123',
        ]);
        $response->assertCreated();
        $this->assertDatabaseHas('users',['name' => 'Ali Siam']);
    }
}

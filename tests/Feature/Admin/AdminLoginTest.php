<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{


    use RefreshDatabase;

    public function testAdminCanLogin()
    {
        $admin =Admin::factory()->create();
        $response = $this->actingAs($admin)->get('/login');
        $response->assertRedirect('/');
    }
}

<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testCanNotNavigateToDashboardIfNotAuthenticated()
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function testCanNotNavigateToDashboardIfRoleIsUser()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('dashboard');
        $response->assertStatus(403);
    }

    public function testCanNavigateToDashboardIfRoleIsAdmin()
    {
        $user = User::factory()->create(['role' => User::ROLE_ADMIN]);

        $response = $this->actingAs($user)->get('dashboard');
        $response->assertOk();
    }
}

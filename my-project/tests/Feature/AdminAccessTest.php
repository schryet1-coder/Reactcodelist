<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;
    public function test_non_admin_cannot_access_admin_routes()
    {
        $user = User::factory()->create(['is_admin' => false]);
        $response = $this->actingAs($user)->get('/admin');
        $response->assertStatus(403);
    }

    public function test_admin_can_access_admin_routes()
    {
        $user = User::factory()->create(['is_admin' => true]);
        $response = $this->actingAs($user)->get('/admin');
        $response->assertStatus(302); // redirects to /admin/subscriptions
    }
}

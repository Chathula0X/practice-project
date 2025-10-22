<?php

namespace Tests\Feature\Client;

use App\Models\Admin;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_method_returns_correct_view()
    {
        $admin = Admin::factory()->create();

        $response = $this->actingAs($admin, 'admins')
            ->get(route('client.index'));

        $response->assertViewIs('admin-dashboard.client.index');
    }

    /** @test */
    public function create_method_returns_create_view()
    {
        $admin = Admin::factory()->create();

        $response = $this->actingAs($admin, 'admins')
            ->get(route('client.create'));

        $response->assertViewIs('admin-dashboard.client.create');
    }

    /** @test */
    public function store_method_creates_client_and_redirects()
    {
        $admin = Admin::factory()->create();

        $response = $this->actingAs($admin, 'admins')
            ->post(route('client.store'), [
                'name' => 'Test',
                'email' => 'test@test.com',
                'phone' => '123',
                'nationality' => 'Test',
            ]);

        $response->assertRedirect(route('client.index'));
        $this->assertCount(1, Client::all());
    }
}
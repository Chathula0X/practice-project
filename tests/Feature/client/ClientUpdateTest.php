<?php

namespace Tests\Feature\Client;

use App\Models\Admin;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientUpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_edit_client_form()
    {
        $admin = Admin::factory()->create();
        $client = Client::factory()->create();

        $response = $this->actingAs($admin, 'admins')
            ->get(route('client.edit', $client->id));

        $response->assertStatus(200);
        $response->assertViewIs('admin-dashboard.client.edit');
        $response->assertViewHas('client');
    }

    /** @test */
    public function it_can_update_an_existing_client()
    {
        $admin = Admin::factory()->create();
        $client = Client::factory()->create(['name' => 'Old Name']);

        $data = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'phone' => '+9999999999',
            'nationality' => 'British',
            'preferences' => 'Mountain resorts',
        ];

        $response = $this->actingAs($admin, 'admins')
            ->put(route('client.update', $client->id), $data);

        $response->assertRedirect(route('client.index'));
        $this->assertDatabaseHas('clients', [
            'id' => $client->id,
            'name' => 'Updated Name',
        ]);
    }

    /** @test */
    public function it_validates_update_data()
    {
        $admin = Admin::factory()->create();
        $client = Client::factory()->create();

        $response = $this->actingAs($admin, 'admins')
            ->put(route('client.update', $client->id), [
                'name' => '',
                'email' => 'invalid',
            ]);

        $response->assertSessionHasErrors(['name', 'email']);
    }

    /** @test */
    public function guest_cannot_update_client()
    {
        $client = Client::factory()->create();

        $response = $this->put(route('client.update', $client->id), [
            'name' => 'Hacker Name',
            'email' => 'hacker@example.com',
            'phone' => '+1234567890',
            'nationality' => 'Unknown',
        ]);

        $response->assertRedirect(route('admin.login'));
    }
}
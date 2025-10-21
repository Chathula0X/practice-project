<?php

namespace Tests\Feature\Client;

use App\Models\Admin;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientDeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_delete_a_client()
    {
        $admin = Admin::factory()->create();
        $client = Client::factory()->create();

        $response = $this->actingAs($admin, 'admins')
            ->delete(route('client.delete', $client->id));

        $response->assertRedirect(route('client.index'));
        $this->assertDatabaseMissing('clients', ['id' => $client->id]);
    }

    /** @test */
    public function it_shows_success_message_after_deletion()
    {
        $admin = Admin::factory()->create();
        $client = Client::factory()->create();

        $response = $this->actingAs($admin, 'admins')
            ->delete(route('client.delete', $client->id));

        $response->assertSessionHas('success', 'Client deleted Successfully');
    }

    /** @test */
    public function unauthorized_users_cannot_delete_clients()
    {
        $client = Client::factory()->create();

        $response = $this->delete(route('client.delete', $client->id));

        $response->assertRedirect(route('admin.login'));
        $this->assertDatabaseHas('clients', ['id' => $client->id]);
    }
}
<?php

namespace Tests\Feature\Client;

use App\Models\Admin;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientListTest extends TestCase{

    use RefreshDatabase;

    /**@test */
    public function it_displays_all_clients_in_the_index_page(){

        $admin = Admin::factory()->create();

        $response = $this->actingAs($admin, 'admins')->get(route('client.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin-dashboard.client.index');

    }

    /**@test */
    public function it_displays_all_clients_in_the_list(){

        $admin = Admin::factory()->create();
        $clients = Client::factory()->count(5)->create();

        $response = $this->actingAs($admin, 'admins')->get(route('client.index'));

        foreach ($clients as $client) {

            $response->assertSee($client->name);
            $response->assertSee($client->email);
        }
    }

    /**@test */
    public function unauthorized_users_cannot_access_the_client_list(){

        $response = $this->get(route('client.index'));

        $response->assertRedirect(route('admin.login'));
    }

    /**@test */
    public function it_passes_clients_to_view(){

        $admin = Admin::factory()->create();
        Client::factory()->count(5)->create();

        $response = $this->actingAs($admin, 'admins')->get(route('client.index'));

        $response->assertViewHas('clients');
    }
}
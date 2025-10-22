<?php

namespace Tests\Feature\Client;

use App\Models\Admin;
use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ClientCreateTest extends TestCase{

    use RefreshDatabase;

    /**@test */
    public function client_create_form_cannot_be_accessed_without_login(){

        $response = $this->get(route('client.create'));

        $response->assertRedirect(route('admin.login'));

    }

    /**@test */
    public function client_create_form_should_validate_the_inputs(){

        $admin = Admin::factory()->create();

        $response = $this->actingAs($admin, 'admins')->post(route('client', store), [
            'name' => '',
            'email' => 'invalid-email',
            'phone' => '',
            'nationality' => '',
        ]);

        $response->assertSessionHasErrors([
            'name',
            'email',
            'phone',
            'nationality',
        ]);

        $this->assertDatabaseCount('clients', 0);
    }
    
    /**@test */
    public function authenticated_admin_can_access_the_create_form(){

        $admin = Admin::factory()->create();

        $responce = $this->actingAs($admin, 'admins')->get(route('client.create'));

        $responce->assertStatus(200);
        $responce->assertViewIs('admin-dashboard.client.create');
    }

    /**@test */
    public function it_creates_client_with_valid_inputs(){

        $admin = Admin::factory()->create();

        $validData = [
            'name' => 'Test Client',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'nationality' => 'Test Nationality',
            'preferences' => 'Test Preferences',
        ];

        $response = $this->actingAs($admin, 'admins')->post(route('client.store'), $validData);

        $response->assertRedirect(route('client.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('clients',[
            'name' => 'Test Client',
            'email' => 'test@example.com',
            'phone' => '1234567890',
            'nationality' => 'Test Nationality',
            'preferences' => 'Test Preferences',
        ]);

    }

    /**@test */
    public function it_validates_name_is_required(){

        $admin = Admin::factory()->create();

        $response = $this->actingAs($admin, 'admins')->post(route('client.store'), [
            'name' => '',
            'email' => 'valid@example.com',
            'phone' => '1234567890',
            'nationality' => 'Test Nationality',
            'preferences' => 'Test Preferences',
        ]);

        $response->assertSessionHasErrors('name');
    }

    /**@test */
    public function it_validates_email_format(){

        $admin = Admin::factory()->create();

        $respomse = $this->actingAs($admin, 'admins')->post(route('client.store'), [
            'name' => 'Test Client',
            'email' => 'invalid-email',
            'phone' => '1234567890',
            'nationality' => 'Test Nationality',
            'preferences' => 'Test Preferences',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /**@test */
    public function preferences_are_optional(){

        $admin = Admin::factory()->create();

        $response = $this->actingAs($admin, 'admins')->post(route('client.store'), [
            'name' => 'Test Client',
            'email' => 'valid@example.com',
            'phone' => '1234567890',
            'nationality' => 'Test Nationality',
            'preferences' => '',
        ]);

        $response->assertRedirect(route('client.index'));
        $this->assertDatabaseHas('clients', ['email' => 'valid@example.com']);
    }

    /**@test */
    public function guest_cannot_submit_the_form(){

        $response = $this->post(route('client.store'), [
            'name' => 'Test Client',
            'email' => 'valid@example.com',
            'phone' => '1234567890',
            'nationality' => 'Test Nationality',
            'preferences' => 'Test Preferences',
        ]);

        $response->assertRedirect(route('admin.login'));
        $this->assertDatabaseCount('clients', 0);
    }

}
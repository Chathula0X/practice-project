<?php

namespace Tests\Feature\Admin;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_login_screen_can_be_rendered()
    {
        $response = $this->get(route('admin.login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function admins_can_authenticate_using_the_login_screen()
    {
        $admin = Admin::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('admin.login.store'), [
            'email' => $admin->email,
            'password' => 'password123',
        ]);

        $this->assertAuthenticatedAs($admin, 'admins');
        $response->assertRedirect(route('admin.dashboard'));
    }

    /** @test */
    public function admins_cannot_authenticate_with_invalid_password()
    {
        $admin = Admin::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post(route('admin.login.store'), [
            'email' => $admin->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest('admins');
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function admin_cannot_login_with_nonexistent_email()
    {
        $response = $this->post(route('admin.login.store'), [
            'email' => 'nonexistent@example.com',
            'password' => 'password123',
        ]);

        $this->assertGuest('admins');
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function authenticated_admin_can_logout()
    {
        $admin = Admin::factory()->create();

        $this->actingAs($admin, 'admins');

        $response = $this->post(route('admin.logout'));

        $this->assertGuest('admins');
        $response->assertRedirect(route('admin.login'));
    }

    /** @test */
    public function authenticated_admin_can_access_admin_dashboard()
    {
        $admin = Admin::factory()->create();

        $response = $this->actingAs($admin, 'admins')
            ->get(route('admin.dashboard'));

        $response->assertStatus(200);
    }

    /** @test */
    public function guest_cannot_access_admin_dashboard()
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('admin.login'));
    }
}
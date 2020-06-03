<?php

namespace Tests\Feature\Admin;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActivateUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_admins_can_activate_users()
    {
        $user = factory(User::class)->create();

        $this->post('admin/activated-users')->assertRedirect('login');

        $this
            ->actingAS($user)
            ->post('admin/activated-users')
            ->assertForbidden();
    }

    /** @test */
    public function successfully_activating_user()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->create();
        $user->deactivate();

        $response = $this
            ->from("admin/users/{$user->id}")
            ->actingAS($admin)
            ->post('admin/activated-users', ['user_id' => $user->id]);

        $response->assertSessionHasFlashMessage('success');
        $response->assertRedirect("admin/users/{$user->id}");
        tap($user->fresh(), function (user $user) {
            $this->assertTrue($user->isActive());
        });
    }

    /** @test */
    public function it_404s_if_invalid_user_id_is_provided()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->create();
        $user->deactivate();

        $response = $this
            ->from("admin/users/{$user->id}")
            ->actingAS($admin)
            ->post('admin/activated-users', ['user_id' => null]);

        $response->assertNotFound();

        $response = $this
            ->from("admin/users/{$user->id}")
            ->actingAS($admin)
            ->post('admin/activated-users', ['user_id' => 999]);

        $response->assertNotFound();
    }
}

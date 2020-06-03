<?php

namespace Tests\Feature\Admin;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeactivateUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_admins_can_deactivate_users()
    {
        $user = factory(User::class)->create();

        $this->post('admin/deactivated-users')->assertRedirect('login');

        $this
            ->actingAS($user)
            ->post('admin/deactivated-users')
            ->assertForbidden();
    }

    /** @test */
    public function successfully_deactivating_user()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->create();
        $user->activate();

        $response = $this
            ->from("admin/users/{$user->id}")
            ->actingAS($admin)
            ->post('admin/deactivated-users', ['user_id' => $user->id]);

        $response->assertSessionHasFlashMessage('success');
        $response->assertRedirect("admin/users/{$user->id}");
        tap($user->fresh(), function (user $user) {
            $this->assertFalse($user->isActive());
        });
    }

    /** @test */
    public function it_404s_if_invalid_user_id_is_provided()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->create();
        $user->activate();

        $response = $this
            ->from("admin/users/{$user->id}")
            ->actingAS($admin)
            ->post('admin/deactivated-users', ['user_id' => null]);

        $response->assertNotFound();

        $response = $this
            ->from("admin/users/{$user->id}")
            ->actingAS($admin)
            ->post('admin/deactivated-users', ['user_id' => 999]);

        $response->assertNotFound();
    }
}

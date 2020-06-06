<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DemoteUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_admins_can_demote_users()
    {
        $user = factory(User::class)->create();

        $this->delete('admin/administrators')->assertRedirect('login');

        $this
            ->actingAS($user)
            ->delete('admin/administrators')
            ->assertForbidden();
    }

    /** @test */
    public function successfully_demoting_user()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->states('admin')->create();

        $response = $this
            ->from("admin/users/{$user->id}")
            ->actingAS($admin)
            ->delete('admin/administrators', ['user_id' => $user->id]);

        $response->assertSessionHasFlashMessage('success');
        $response->assertRedirect("admin/users/{$user->id}");
        tap($user->fresh(), function (user $user) {
            $this->assertFalse($user->isAdmin());
        });
    }

    /** @test */
    public function it_404s_if_invalid_user_id_is_provided()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->create();

        $response = $this
            ->from("admin/users/{$user->id}")
            ->actingAS($admin)
            ->delete('admin/administrators', ['user_id' => null]);

        $response->assertNotFound();

        $response = $this
            ->from("admin/users/{$user->id}")
            ->actingAS($admin)
            ->delete('admin/administrators', ['user_id' => 999]);

        $response->assertNotFound();
    }
}

<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PromoteUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_admins_can_promote_users()
    {
        $user = factory(User::class)->create();

        $this->post('admin/administrators')->assertRedirect('login');

        $this
            ->actingAS($user)
            ->post('admin/administrators')
            ->assertForbidden();
    }

    /** @test */
    public function successfully_promoting_user()
    {
        $admin = factory(User::class)->states('admin')->create();
        $user = factory(User::class)->create();

        $response = $this
            ->from("admin/users/{$user->id}")
            ->actingAS($admin)
            ->post('admin/administrators', ['user_id' => $user->id]);

        $response->assertSessionHasFlashMessage('success');
        $response->assertRedirect("admin/users/{$user->id}");
        tap($user->fresh(), function (user $user) {
            $this->assertTrue($user->isAdmin());
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
            ->post('admin/administrators', ['user_id' => null]);

        $response->assertNotFound();

        $response = $this
            ->from("admin/users/{$user->id}")
            ->actingAS($admin)
            ->post('admin/administrators', ['user_id' => 999]);

        $response->assertNotFound();
    }
}

<?php

namespace Tests\Feature\Admin;

use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_admins_can_see_all_users()
    {
        $user = factory(User::class)->create();

        $this->get('admin/users')
            ->assertRedirect('login');

        $this->actingAs($user)
            ->get('admin/users')
            ->assertForbidden();
    }

    /** @test */
    public function seeing_all_users()
    {
        $admin = factory(User::class)->states('admin')->create();
        $userA = factory(User::class)->create();
        $userB = factory(User::class)->create();

        $response = $this->actingAs($admin)->get('admin/users');

        $response
            ->assertOk()
            ->assertViewHas(
                'users',
                fn (Collection $users) => $users->contains($admin) &&
                $users->contains($userA) &&
                $users->contains($userB)
            );
    }
}

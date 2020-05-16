<?php

namespace Tests\Feature;

use App\Events\UserInvited;
use App\User;
use Facades\App\TokenGenerator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class InviteUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_admins_can_invite_new_user()
    {
        $user = factory(User::class)->create();

        $this->post('users/invite')->assertForbidden();

        $this
            ->actingAS($user)
            ->post('users/invite')
            ->assertForbidden();
    }

    /** @test */
    public function successfully_inviting_new_user()
    {
        Event::fake();
        TokenGenerator::shouldReceive('generate')
            ->once()
            ->andReturn('TOKEN_123456');

        $admin = factory(User::class)->states('admin')->create();

        $response = $this->actingAs($admin)->post('users/invite', ['email' => 'johndoe@example.com']);

        $response->assertCreated();
        $this->assertDatabaseHas('users', [
            'email' => 'johndoe@example.com',
            'token' => 'TOKEN_123456',
        ]);

        $user = User::findByEmail('johndoe@example.com');

        Event::assertDispatched(UserInvited::class, function ($event) use ($user) {
            return $event->user->is($user);
        });
    }

    /** @test */
    public function email_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();

        $response = $this->actingAs($admin)->post('users/invite', ['email' => null]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_must_be_valid_email()
    {
        $admin = factory(User::class)->states('admin')->create();

        $response = $this->actingAs($admin)->post('users/invite', ['email' => 'not-a-valid-email']);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_must_be_unique()
    {
        $admin = factory(User::class)->states('admin')->create();
        factory(User::class)->create(['email' => 'johndoe@example.com']);

        $response = $this->actingAs($admin)->post('users/invite', ['email' => 'johndoe@example.com']);

        $response->assertSessionHasErrors('email');
    }
}

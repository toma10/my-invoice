<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_be_found_by_email()
    {
        $user = factory(User::class)->create(['email' => 'johndoe@example.com']);

        $foundUser = User::findByEmail('johndoe@example.com');

        $this->assertTrue($foundUser->is($user));
    }

    /** @test */
    public function it_can_determine_if_user_is_admin()
    {
        $user = factory(User::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $this->assertFalse($user->isAdmin());
        $this->assertFalse($user->is_admin);

        $this->assertTrue($admin->isAdmin());
        $this->assertTrue($admin->is_admin);
    }

    /** @test */
    public function user_can_be_invited()
    {
        $user = User::invite('johndoe@example.com', 'token');

        tap($user->fresh(), function ($user) {
            $this->assertTrue($user->exists());
            $this->assertEquals('johndoe@example.com', $user->email);
            $this->assertEquals('token', $user->token);
            $this->assertFalse($user->isAdmin());
        });
    }
}

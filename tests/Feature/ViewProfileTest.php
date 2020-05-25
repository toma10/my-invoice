<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_see_profile_page()
    {
        $this->get('profile')->assertRedirect('login');
    }

    /** @test */
    public function user_can_see_his_profile()
    {
        $user = factory(User::class)->create(['email' => 'johndoe@example.com']);

        $response = $this->actingAs($user)->get('profile');

        $response->assertOk();
        $response->assertSee($user->email);
    }
}

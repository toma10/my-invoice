<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function successfully_logging_out()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post('logout');

        $response->assertRedirect('login');
        $this->assertGuest();
    }
}

<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_guests_can_see_login_page()
    {
        $user = factory(User::class)->create();

        $this->get('login')->assertOk();

        $this
            ->actingAs($user)
            ->get('login')
            ->assertRedirect('invoices');
    }

    /** @test */
    public function only_guests_can_log_in()
    {
        $user = factory(User::class)->create();

        $this
            ->actingAs($user)
            ->post('login')
            ->assertRedirect('invoices');
    }

    /** @test */
    public function successfully_logging_in()
    {
        factory(User::class)->create([
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('login', [
            'email' => 'johndoe@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('invoices');
        $this->assertAuthenticated();
    }

    /** @test */
    public function it_returns_error_if_login_failed()
    {
        factory(User::class)->create([
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->from('login')->post('login', [
            'email' => 'johndoe@example.com',
            'password' => 'invalid-password',
        ]);

        $response->assertRedirect('login');
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_is_required()
    {
        $response = $this->post('login', [
            'email' => null,
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_must_be_valid_email()
    {
        $response = $this->post('login', [
            'email' => 'not-a-valid-email',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function password_is_required()
    {
        $response = $this->post('login', [
            'email' => 'johndoe@example.com',
            'password' => null,
        ]);

        $response->assertSessionHasErrors('password');
    }
}

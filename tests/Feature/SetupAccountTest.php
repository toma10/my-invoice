<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use App\TokenGenerator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SetupAccountTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_guests_can_view_welcome_page()
    {
        $user = factory(User::class)->create();

        $this->get('welcome/TOKEN')->assertOk();

        $this
            ->actingAs($user)
            ->get('welcome/TOKEN')
            ->assertRedirect('/');
    }

    /** @test */
    public function only_guests_can_setup_account()
    {
        $user = factory(User::class)->create();

        $this
            ->actingAs($user)
            ->post('welcome')
            ->assertRedirect('/');
    }

    /** @test */
    public function successfully_setting_up_account()
    {
        $token = (new TokenGenerator())->generate();

        $user = factory(User::class)->create([
            'email' => 'johndoe@example.com',
            'password' => null,
            'token' => $token,
        ]);

        $response = $this->post('welcome', [
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => $token,
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticated();
        tap($user->fresh(), function ($user) {
            $this->assertNotNull($user->password);
            $this->assertNull($user->token);
            $this->assertTrue(Hash::check('password', $user->password));
        });
    }

    /** @test */
    public function it_400s_if_user_does_not_exist()
    {
        $token = (new TokenGenerator())->generate();

        $response = $this->post('welcome', [
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => $token,
        ]);

        $response->assertStatus(400);
    }

    /** @test */
    public function it_400s_if_token_is_invalid()
    {
        $token = (new TokenGenerator())->generate();

        $user = factory(User::class)->create([
            'email' => 'johndoe@example.com',
            'password' => null,
            'token' => $token,
        ]);

        $response = $this->post('welcome', [
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => 'not-a-valid-token',
        ]);

        $response->assertStatus(400);
        tap($user->fresh(), function ($user) {
            $this->assertNull($user->password);
            $this->assertNotNull($user->token);
        });
    }

    /** @test */
    public function email_is_required()
    {
        $response = $this->post('welcome', [
            'email' => null,
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => 'TOKEN_123456',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_must_be_valid_email()
    {
        $response = $this->post('welcome', [
            'email' => 'not-a-valid-email',
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => 'TOKEN_123456',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function password_is_required()
    {
        $response = $this->post('welcome', [
            'email' => 'johndoe@example.com',
            'password' => null,
            'password_confirmation' => 'password',
            'token' => 'TOKEN_123456',
        ]);

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function password_must_have_at_least_8_characters()
    {
        $response = $this->post('welcome', [
            'email' => 'johndoe@example.com',
            'password' => 'invalid',
            'password_confirmation' => 'invalid',
            'token' => 'TOKEN_123456',
        ]);

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function password_must_be_confirmed()
    {
        $response = $this->post('welcome', [
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'john-doe',
            'token' => 'TOKEN_123456',
        ]);

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function token_is_required()
    {
        $response = $this->post('welcome', [
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'token' => null,
        ]);

        $response->assertSessionHasErrors('token');
    }
}

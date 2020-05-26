<?php

namespace Tests\Feature;

use App\Notifications\ResetPasswordNotification;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Notification::fake();
    }

    /** @test */
    public function user_must_be_guest_to_visit_reset_password_page()
    {
        $user = factory(User::class)->create();
        $url = URL::temporarySignedRoute('password.reset', now()->addDay(), ['email' => $user->email]);

        $this->get('password/reset')->assertOK();
        $this->get($url)->assertOK();

        $this->actingAs($user)->get('password/reset')->assertRedirect('invoices');
        $this->actingAs($user)->get('password/reset/TOKEN')->assertRedirect('invoices');
    }

    /** @test */
    public function user_must_be_guest_to_reset_password()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->post('password/email')->assertRedirect('invoices');
        $this->actingAs($user)->post('password/reset')->assertRedirect('invoices');
    }

    /** @test */
    public function successfully_sending_reset_password_notification()
    {
        $user = factory(User::class)->create(['email'=> 'johndoe@example.com']);

        $response = $this
            ->from('password/reset')
            ->post('password/email', ['email' => 'johndoe@example.com']);

        $response->assertRedirect('password/reset');
        $response->assertSessionHasFlashMessage('success');

        Notification::assertSentTo($user, ResetPasswordNotification::class);
    }

    /** @test */
    public function successfully_resetting_password()
    {
        $user = factory(User::class)->create(['email'=> 'johndoe@example.com']);
        $url = URL::temporarySignedRoute('password.reset', now()->addDay(), ['email' => $user->email]);

        $response = $this
            ->from($url)
            ->post('password/reset', [
                'email' => 'johndoe@example.com',
                'password' => 'new-password',
                'password_confirmation' => 'new-password',
            ]);

        $response->assertRedirect('invoices');
        $response->assertSessionHasFlashMessage('success');
        $this->assertAuthenticated();
        tap($user->fresh(), function ($user) {
            Hash::check('new-password', $user->password);
        });
    }

    /** @test */
    public function email_is_required_when_sending_reset_password_notification()
    {
        $response = $this->post('password/email', ['email' => null]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_must_be_valid_email_when_sending_reset_password_notification()
    {
        $response = $this->post('password/email', ['email' => 'not-a-valid-email']);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_must_exist_when_sending_reset_password_notification()
    {
        $user = factory(User::class)->create(['email' => 'jackdoe@example.com']);

        $response = $this->post('password/email', ['email' => 'johndoe@example.com']);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_is_required_when_resetting_password()
    {
        $response = $this->post('password/reset', ['email' => null]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_must_be_valid_email_when_resetting_password()
    {
        $response = $this->post('password/reset', [
            'email' => 'not-a-valid-email',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_must_exist_when_resetting_password()
    {
        $user = factory(User::class)->create(['email' => 'jackdoe@example.com']);

        $response = $this->post('password/reset', [
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function password_is_required_when_resetting_password()
    {
        $response = $this->post('password/reset', [
            'email' => 'johndoe@example.com',
            'password' => null,
            'password_confirmation' => 'password',
        ]);

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function password_must_have_at_least_8_characters_when_resetting_password()
    {
        $response = $this->post('password/reset', [
            'email' => 'johndoe@example.com',
            'password' => 'invalid',
            'password_confirmation' => 'invalid',
        ]);

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function password_must_be_confirmed_when_resetting_password()
    {
        $response = $this->post('password/reset', [
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'password_confirmation' => 'john-doe',
        ]);

        $response->assertSessionHasErrors('password');
    }
}

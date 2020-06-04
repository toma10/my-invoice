<?php

namespace Tests\Feature;

use App\NotificationsSetting;
use App\User;
use Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_see_edit_profile_page()
    {
        $this->get('profile/edit')->assertRedirect('login');
    }

    /** @test */
    public function user_can_see_edit_profile_page()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('profile/edit');

        $response
            ->assertOk()
            ->assertViewHas(
                'user',
                fn (User $givenUser) => $givenUser->is($user)
            )
            ->assertViewHas(
                'notificationsSetting',
                fn (NotificationsSetting $notificationsSetting) => $notificationsSetting->user_id === $user->id
            );
    }

    /** @test */
    public function successfully_editing_profile()
    {
        $user = factory(User::class)->create();

        $response = $this->from('profile/edit')->actingAs($user)->put('profile', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ]);

        $response->assertRedirect('profile/edit');
        $response->assertSessionHasFlashMessage('success');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    public function requiredFieldsProvider(): Generator
    {
        yield ['name'];
        yield ['email'];
    }

    /**
     * @dataProvider requiredFieldsProvider
     * @test
     */
    public function required_fields(string $field)
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->put('profile', $this->getValidParams([$field => null]));

        $response->assertSessionHasErrors($field);
    }

    /** @test */
    public function email_must_be_valid_email()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->put('profile', $this->getValidParams(['email' => 'not-a-valid-email']));

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function email_must_be_unique()
    {
        $user = factory(User::class)->create();
        factory(User::class)->create(['email' => 'johndoe@example.com']);

        $response = $this->actingAs($user)->put('profile', $this->getValidParams(['email' => 'johndoe@example.com']));

        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function user_doesnt_have_to_change_email()
    {
        $user = factory(User::class)->create(['email' => 'johndoe@example.com']);

        $response = $this->actingAs($user)->put('profile', $this->getValidParams(['email' => 'johndoe@example.com']));

        $response->assertSessionDoesntHaveErrors('email');
    }

    protected function getValidParams(array $overrides = []): array
    {
        return array_merge([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ], $overrides);
    }
}

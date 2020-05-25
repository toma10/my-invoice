<?php

namespace Tests\Feature;

use App\User;
use Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ChangePasswordTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_logged_in()
    {
        $this->post('password')->assertRedirect('login');
    }

    /** @test */
    public function successfully_changing_password()
    {
        $user = factory(User::class)->create(['password' => bcrypt('password')]);

        $response = $this->from('profile/edit')->actingAs($user)->post('password', [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $response
            ->assertRedirect('profile/edit')
            ->assertSessionHasFlashMessage('success');
        $this->assertTrue(Hash::check('new-password', $user->fresh()->password));
    }

    public function requiredFieldsProvider(): Generator
    {
        yield ['current_password'];
        yield ['password'];
    }

    /**
     * @dataProvider requiredFieldsProvider
     * @test
     */
    public function required_fields(string $field)
    {
        $user = factory(User::class)->create(['password' => bcrypt('password')]);

        $response = $this->actingAs($user)->post('password', $this->getValidParams([$field => null]));

        $response->assertSessionHasErrors($field);
    }

    /** @test */
    public function current_password_must_be_correct()
    {
        $user = factory(User::class)->create(['password' => bcrypt('password')]);

        $response = $this->actingAs($user)->post('password', $this->getValidParams(['current_password' => 'not-a-valid-password']));

        $response->assertSessionHasErrors('current_password');
    }

    /** @test */
    public function password_must_have_at_least_8_characters()
    {
        $user = factory(User::class)->create(['password' => bcrypt('password')]);

        $response = $this->actingAs($user)->post('password', $this->getValidParams(['password' => 'invalid']));

        $response->assertSessionHasErrors('password');
    }

    /** @test */
    public function password_must_be_confirmed()
    {
        $user = factory(User::class)->create(['password' => bcrypt('password')]);

        $response = $this->actingAs($user)->post('password', $this->getValidParams([
            'password' => 'new-password',
            'password_confirmation' => 'john-doe',
        ]));

        $response->assertSessionHasErrors('password');
    }

    protected function getValidParams(array $overrides = []): array
    {
        return array_merge([
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ], $overrides);
    }
}

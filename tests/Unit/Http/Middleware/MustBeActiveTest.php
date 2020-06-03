<?php

namespace Tests\Unit\Http\Middleware;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class MustBeActiveTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware('web')->name('testRoute')->get('_test', function () {
            return 'OK';
        });
    }

    /** @test */
    public function it_redirects_to_login_page_if_user_is_deactivated()
    {
        $user = factory(User::class)->create();
        $user->deactivate();

        $response = $this->actingAs($user)->get('_test');

        $response->assertRedirect('login');
        $response->assertSessionHasFlashMessage('error');
        $this->assertGuest();
    }

    /** @test */
    public function it_passes_response_if_user_is_active()
    {
        $admin = factory(User::class)->create();

        $response = $this->actingAs($admin)->get('_test');

        $response->assertOK();
    }
}

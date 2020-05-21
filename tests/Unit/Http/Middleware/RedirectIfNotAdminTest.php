<?php

namespace Tests\Unit\Http\Middleware;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class RedirectIfNotAdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Route::middleware('admin')->get('_test/admin', function () {
            return 'OK';
        });
    }

    /** @test */
    public function it_redirects_to_login_page_if_user_is_not_logged_in()
    {
        $user = factory(User::class)->create();

        $response = $this->get('_test/admin');

        $response->assertRedirect('login');
    }

    /** @test */
    public function it_403_if_user_is_not_an_admin()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('_test/admin');

        $response->assertForbidden();
    }

    /** @test */
    public function it_passes_response_if_user_is_an_admin()
    {
        $admin = factory(User::class)->states('admin')->create();

        $response = $this->actingAs($admin)->get('_test/admin');

        $response->assertOK();
    }
}

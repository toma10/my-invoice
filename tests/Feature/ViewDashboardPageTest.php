<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewDashboardPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_admins_can_see_dashboard_page()
    {
        $user = factory(User::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $this->get('admin')->assertRedirect('login');
        $this->actingAs($user)->get('admin')->assertForbidden();
        $this->actingAs($admin)->get('admin')->assertOk();
    }
}

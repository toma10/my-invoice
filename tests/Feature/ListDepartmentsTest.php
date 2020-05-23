<?php

namespace Tests\Feature;

use App\Department;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListDepartmentsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_admins_can_see_all_users()
    {
        $user = factory(User::class)->create();

        $this->get('admin/departments')
            ->assertRedirect('login');

        $this->actingAs($user)
            ->get('admin/departments')
            ->assertForbidden();
    }

    /** @test */
    public function seeing_all_users()
    {
        $admin = factory(User::class)->states('admin')->create();
        $departmentA = factory(Department::class)->create();
        $departmentB = factory(Department::class)->create();

        $response = $this->actingAs($admin)->get('admin/departments');

        $response
            ->assertOk()
            ->assertViewHas(
                'departments',
                fn ($departments) => $departments->contains($departmentA) &&
                $departments->contains($departmentB)
            );
    }
}

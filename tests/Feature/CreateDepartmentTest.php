<?php

namespace Tests\Feature;

use App\Department;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateDepartmentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_admins_can_view_create_depratment_page()
    {
        $user = factory(User::class)->create();
        $admin = factory(User::class)->states('admin')->create();

        $this->get('admin/departments/create')
            ->assertRedirect('login');

        $this->actingAs($user)
            ->get('admin/departments/create')
            ->assertForbidden();

        $this->actingAs($admin)
            ->get('admin/departments/create')
            ->assertOk();
    }

    /** @test */
    public function only_admins_can_create_invoices()
    {
        $user = factory(User::class)->create();

        $this->post('admin/departments')->assertRedirect('login');

        $this->actingAs($user)
            ->post('admin/departments')
            ->assertForbidden();
    }

    /** @test */
    public function successfully_creating_department()
    {
        $admin = factory(User::class)->states('admin')->create();

        $response = $this
            ->from('admin/departments/create')
            ->actingAs($admin)
            ->post('admin/departments', ['name' => 'Depratment ABC']);

        $response->assertSessionHasFlashMessage('success');
        $response->assertRedirect('admin/departments/create');
        $this->assertDatabaseHas('departments', [
            'name' => 'Depratment ABC',
        ]);
    }

    /** @test */
    public function name_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();

        $response = $this->actingAs($admin)->post(
            'admin/departments',
            ['name' => null]
        );

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_must_be_unique()
    {
        $admin = factory(User::class)->states('admin')->create();
        factory(Department::class)->create(['name' => 'Department Abc']);

        $response = $this->actingAs($admin)->post(
            'admin/departments',
            ['name' => 'Department Abc']
        );

        $response->assertSessionHasErrors('name');
    }
}

<?php

namespace Tests\Feature\Admin;

use App\Department;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditDepartmentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_admins_can_view_edit_department_page()
    {
        $user = factory(User::class)->create();
        $admin = factory(User::class)->states('admin')->create();
        $department = factory(Department::class)->create();

        $this->get("admin/departments/{$department->id}/edit")
            ->assertRedirect('login');

        $this->actingAs($user)
            ->get("admin/departments/{$department->id}/edit")
            ->assertForbidden();

        $this->actingAs($admin)
            ->get("admin/departments/{$department->id}/edit")
            ->assertOk();
    }

    /** @test */
    public function only_admins_can_edit_departments()
    {
        $user = factory(User::class)->create();
        $department = factory(Department::class)->create();

        $this->put("admin/departments/{$department->id}")->assertRedirect('login');

        $this->actingAs($user)
            ->put("admin/departments/{$department->id}")
            ->assertForbidden();
    }

    /** @test */
    public function successfully_editing_department()
    {
        $admin = factory(User::class)->states('admin')->create();
        $department = factory(Department::class)->create();

        $response = $this
            ->from("admin/departments/{$department->id}/edit")
            ->actingAs($admin)
            ->put("admin/departments/{$department->id}", ['name' => 'Department ABC']);

        $response->assertRedirect("admin/departments/{$department->id}/edit");
        $response->assertSessionHasFlashMessage('success');
        $this->assertDatabaseHas('departments', [
            'id' => $department->id,
            'name' => 'Department ABC',
        ]);
    }

    /** @test */
    public function name_is_required()
    {
        $admin = factory(User::class)->states('admin')->create();
        $department = factory(Department::class)->create();

        $response = $this
            ->actingAs($admin)
            ->put("admin/departments/{$department->id}", ['name' => null]);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_must_be_unique()
    {
        $admin = factory(User::class)->states('admin')->create();
        $department = factory(Department::class)->create();
        factory(Department::class)->create(['name' => 'Department ABC']);

        $response = $this
            ->actingAs($admin)
            ->put("admin/departments/{$department->id}", ['name' => 'Department ABC']);

        $response->assertSessionHasErrors('name');
    }

    /** @test */
    public function name_doesnt_have_to_be_changed()
    {
        $admin = factory(User::class)->states('admin')->create();
        $department = factory(Department::class)->create(['name' => 'Department ABC']);

        $response = $this
            ->actingAs($admin)
            ->put("admin/departments/{$department->id}", ['name' => 'Department ABC']);

        $response->assertSessionDoesntHaveErrors('name');
    }
}

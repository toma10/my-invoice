<?php

namespace Tests\Unit;

use App\Department;
use App\Invoice;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        $this->assertTrue($invoice->user->is($user));
    }

    /** @test */
    public function it_belongs_to_a_department()
    {
        $department = factory(Department::class)->create();
        $invoice = factory(Invoice::class)->create(['department_id' => $department]);

        $this->assertTrue($invoice->department->is($department));
    }
}

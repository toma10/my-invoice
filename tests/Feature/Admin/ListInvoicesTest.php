<?php

namespace Tests\Feature\Admin;

use App\Invoice;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Pagination\LengthAwarePaginator;
use Tests\TestCase;

class ListInvoicesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_admins_can_see_all_invoices()
    {
        $user = factory(User::class)->create();

        $this->get('admin/invoices')
            ->assertRedirect('login');

        $this->actingAs($user)
            ->get('admin/invoices')
            ->assertForbidden();
    }

    /** @test */
    public function seeing_all_users()
    {
        $admin = factory(User::class)->states('admin')->create();
        $invoiceA = factory(Invoice::class)->create();
        $invoiceB = factory(Invoice::class)->create();

        $response = $this->actingAs($admin)->get('admin/invoices');

        $response
            ->assertOk()
            ->assertViewHas(
                'invoices',
                fn (LengthAwarePaginator $invocies) => $invocies->contains($invoiceA) &&
                $invocies->contains($invoiceB)
            );
    }
}

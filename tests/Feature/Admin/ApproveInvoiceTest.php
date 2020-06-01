<?php

namespace Tests\Feature\Admin;

use App\Invoice;
use App\InvoiceStatus;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApproveInvoiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_admins_can_approve_invoices()
    {
        $user = factory(User::class)->create();

        $this->post('admin/approved-invoices')->assertRedirect('login');

        $this
            ->actingAS($user)
            ->post('admin/approved-invoices')
            ->assertForbidden();
    }

    /** @test */
    public function successfully_approving_invoice()
    {
        $admin = factory(User::class)->states('admin')->create();
        $invoice = factory(Invoice::class)->create();

        $response = $this
            ->from("admin/invoices/{$invoice->id}")
            ->actingAS($admin)
            ->post('admin/approved-invoices', ['invoice_id' => $invoice->id]);

        $response->assertSessionHasFlashMessage('success');
        $response->assertRedirect("admin/invoices/{$invoice->id}");
        tap($invoice->fresh(), function (Invoice $invoice) {
            $this->assertTrue($invoice->status->is(InvoiceStatus::fromName('approved')));
        });
    }

    /** @test */
    public function it_404s_if_invalid_invoice_id_is_provided()
    {
        $admin = factory(User::class)->states('admin')->create();
        $invoice = factory(Invoice::class)->create();

        $response = $this
            ->from("admin/invoices/{$invoice->id}")
            ->actingAS($admin)
            ->post('admin/approved-invoices', ['invoice_id' => null]);

        $response->assertNotFound();

        $response = $this
            ->from("admin/invoices/{$invoice->id}")
            ->actingAS($admin)
            ->post('admin/approved-invoices', ['invoice_id' => 999]);

        $response->assertNotFound();
    }
}

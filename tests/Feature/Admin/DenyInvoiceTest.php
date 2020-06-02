<?php

namespace Tests\Feature\Admin;

use App\Invoice;
use App\InvoiceActivityTypes;
use App\InvoiceStatus;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Activitylog\Models\Activity;
use Tests\TestCase;

class DenyInvoiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_admins_can_deny_invoices()
    {
        $user = factory(User::class)->create();

        $this->post('admin/denied-invoices')->assertRedirect('login');

        $this
            ->actingAS($user)
            ->post('admin/denied-invoices')
            ->assertForbidden();
    }

    /** @test */
    public function successfully_dening_invoice()
    {
        $admin = factory(User::class)->states('admin')->create();
        $invoice = factory(Invoice::class)->create();

        $response = $this
            ->from("admin/invoices/{$invoice->id}")
            ->actingAS($admin)
            ->post('admin/denied-invoices', ['invoice_id' => $invoice->id]);

        $response->assertSessionHasFlashMessage('success');
        $response->assertRedirect("admin/invoices/{$invoice->id}");
        tap($invoice->fresh(), function (Invoice $invoice) {
            $this->assertTrue($invoice->status->is(InvoiceStatus::fromName(InvoiceStatus::DENIED)));
            $invoice->activity->assertContains(
                fn (Activity $activity) => $activity->description === InvoiceActivityTypes::DENIED
            );
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
            ->post('admin/denied-invoices', ['invoice_id' => null]);

        $response->assertNotFound();

        $response = $this
            ->from("admin/invoices/{$invoice->id}")
            ->actingAS($admin)
            ->post('admin/denied-invoices', ['invoice_id' => 999]);

        $response->assertNotFound();
    }

    /** @test */
    public function it_cannot_be_approved_if_invoice_is_already_denied_or_approved()
    {
        $admin = factory(User::class)->states('admin')->create();
        $approvedInvoice = factory(Invoice::class)->create();
        $approvedInvoice->approve();
        $deniedInvoice = factory(Invoice::class)->create();
        $deniedInvoice->deny();

        $this
            ->actingAS($admin)
            ->post('admin/denied-invoices', ['invoice_id' => $approvedInvoice->id])
            ->assertForbidden();

        $this
            ->actingAS($admin)
            ->post('admin/denied-invoices', ['invoice_id' => $deniedInvoice->id])
            ->assertForbidden();
    }
}

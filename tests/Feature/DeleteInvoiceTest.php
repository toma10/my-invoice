<?php

namespace Tests\Feature;

use App\Invoice;
use App\Status;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DeleteInvoiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_delete_only_his_invoices()
    {
        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);
        $otherUser = factory(User::class)->create();
        $otherUserInvoice = factory(Invoice::class)->create(['user_id' => $otherUser]);

        $this->delete("invoices/{$invoice->id}")
            ->assertRedirect('login');

        $this->actingAs($user)
            ->delete("invoices/{$otherUserInvoice->id}")
            ->assertNotFound();
    }

    /** @test */
    public function successfully_deleting_invoice()
    {
        Storage::fake();

        $user = factory(User::class)->create();
        $pdf = File::create('invoice-2020-05.pdf');
        $pdfPath = Storage::putFile('invoices', $pdf);
        $invoice = factory(Invoice::class)->create([
            'user_id' => $user,
            'pdf_file_path' => $pdfPath,
            'pdf_file_filename' => 'invoice-2020-05.pdf',
        ]);

        $response = $this->actingAs($user)->delete("invoices/{$invoice->id}");

        $response->assertRedirect('invoices');
        $response->assertSessionHasFlashMessage('success');
        $this->assertDatabaseMissing('invoices', ['id' => $invoice->id]);
        Storage::assertMissing($invoice->pdf_file_path);
    }

    /** @test */
    public function user_cannot_delete_invoice_when_invoice_is_paid_or_denied()
    {
        $user = factory(User::class)->create();
        $approvedInvoice = factory(Invoice::class)->create(['user_id' => $user]);
        $approvedInvoice->update(['status_id' => Status::fromName(Status::APPROVED)->id]);
        $paidInvoice = factory(Invoice::class)->create(['user_id' => $user]);
        $paidInvoice->update(['status_id' => Status::fromName(Status::PAID)->id]);
        $deniedInvoice = factory(Invoice::class)->create(['user_id' => $user]);
        $deniedInvoice->update(['status_id' => Status::fromName(Status::DENIED)->id]);

        $this
            ->actingAs($user)
            ->delete("invoices/{$approvedInvoice->id}")
            ->assertForbidden();

        $this
            ->actingAs($user)
            ->delete("invoices/{$paidInvoice->id}")
            ->assertForbidden();

        $this
            ->actingAs($user)
            ->delete("invoices/{$deniedInvoice->id}")
            ->assertForbidden();
    }
}

<?php

namespace Tests\Feature;

use App\Invoice;
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

        $response = $this->actingAs($user)
            ->delete("invoices/{$invoice->id}");

        $response->assertRedirect('/');
        $this->assertDatabaseMissing('invoices', ['id' => $invoice->id]);
        Storage::assertMissing($invoice->pdf_file_path);
    }
}

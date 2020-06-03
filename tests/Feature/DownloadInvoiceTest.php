<?php

namespace Tests\Feature;

use App\Invoice;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DownloadInvoiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_download_invoices()
    {
        $invoice = factory(Invoice::class)->create();

        $this->post("invoices/{$invoice->id}/download")->assertRedirect('login');
    }

    /** @test */
    public function user_can_download_only_his_invoices()
    {
        Storage::fake();
        $pdf = File::create('invoice-2020-05.pdf');
        $pdfPath = Storage::putFile('invoices', $pdf);

        $me = factory(User::class)->create();
        $myInvoice = factory(Invoice::class)->create([
            'user_id' => $me,
            'pdf_file_path' => $pdfPath,
        ]);
        $otherUser = factory(User::class)->create();
        $otherUserInvoice = factory(Invoice::class)->create(['user_id' => $otherUser]);

        $this->actingAs($me)->post("invoices/{$myInvoice->id}/download")->assertOk();
        $this->actingAs($me)->post("invoices/{$otherUserInvoice->id}/download")->assertNotFound();
    }

    /** @test */
    public function admin_can_download_all_invoices()
    {
        Storage::fake();
        $pdf = File::create('invoice-2020-05.pdf');
        $pdfPath = Storage::putFile('invoices', $pdf);

        $admin = factory(User::class)->states('admin')->create();
        $adminInvoice = factory(Invoice::class)->create([
            'user_id' => $admin,
            'pdf_file_path' => $pdfPath,
        ]);
        $otherUser = factory(User::class)->create();
        $otherUserInvoice = factory(Invoice::class)->create([
            'user_id' => $otherUser,
            'pdf_file_path' => $pdfPath,
        ]);

        $this->actingAs($admin)->post("invoices/{$adminInvoice->id}/download")->assertOk();
        $this->actingAs($admin)->post("invoices/{$otherUserInvoice->id}/download")->assertOk();
    }
}

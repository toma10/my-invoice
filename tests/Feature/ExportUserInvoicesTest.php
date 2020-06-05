<?php

namespace Tests\Feature;

use App\Exports\UserInvoicesExport;
use App\Invoice;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class ExportUserInvoicesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_download_invoices()
    {
        $invoice = factory(Invoice::class)->create();

        $this->post('export-invoices')->assertRedirect('login');
    }

    /** @test */
    public function user_can_export_only_his_invoices()
    {
        Excel::fake();

        $me = factory(User::class)->create();
        $myInvoice = factory(Invoice::class)->create(['user_id' => $me]);
        $otherUser = factory(User::class)->create();
        $otherUserInvoice = factory(Invoice::class)->create(['user_id' => $otherUser]);

        $this->actingAs($me)->post('export-invoices');

        Excel::assertDownloaded(
            'invoices.xlsx',
            fn (UserInvoicesExport $export) => $export->collection()->count() === 1
        );
    }
}

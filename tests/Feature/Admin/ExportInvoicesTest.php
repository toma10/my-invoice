<?php

namespace Tests\Feature;

use App\Exports\InvoicesExport;
use App\Invoice;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class ExportInvoicesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_admins_can_export_invoices()
    {
        $user = factory(User::class)->create();

        $this->post('admin/export-invoices')->assertRedirect('login');

        $this
            ->actingAS($user)
            ->post('admin/export-invoices')
            ->assertForbidden();
    }

    /** @test */
    public function user_can_export_only_his_invoices()
    {
        Excel::fake();

        $admin = factory(User::class)->states('admin')->create();
        factory(Invoice::class)->create();
        factory(Invoice::class)->create();

        $this->actingAs($admin)->post('admin/export-invoices');

        Excel::assertDownloaded(
            'invoices.xlsx',
            fn (InvoicesExport $export) => $export->collection()->count() === 2
        );
    }
}

<?php

namespace Tests\Feature;

use App\Invoice;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewInvoiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_see_invoices()
    {
        $invoice = factory(Invoice::class)->create();

        $this->get("invoices/{$invoice->id}")->assertRedirect('login');
    }

    /** @test */
    public function user_can_see_only_his_invoices()
    {
        $me = factory(User::class)->create();
        $myInvoice = factory(Invoice::class)->create(['user_id' => $me]);
        $otherUser = factory(User::class)->create();
        $otherUserInvoice = factory(Invoice::class)->create(['user_id' => $otherUser]);

        $this->actingAs($me)->get("invoices/{$myInvoice->id}")->assertOk();
        $this->actingAs($me)->get("invoices/{$otherUserInvoice->id}")->assertNotFound();
    }
}

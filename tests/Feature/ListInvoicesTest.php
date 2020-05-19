<?php

namespace Tests\Feature;

use App\Invoice;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListInvoicesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_see_invoices()
    {
        $invoice = factory(Invoice::class)->create();

        $this->get('/')->assertRedirect('login');
    }

    /** @test */
    public function user_see_only_his_invoices()
    {
        $me = factory(User::class)->create();
        $myInvoiceA = factory(Invoice::class)->create(['user_id' => $me]);
        $otherUser = factory(User::class)->create();
        $otherUserInvoice = factory(Invoice::class)->create(['user_id' => $otherUser]);
        $myInvoiceB = factory(Invoice::class)->create(['user_id' => $me]);

        $response = $this->actingAs($me)->get('/');

        $response
            ->assertOk()
            ->assertViewHas(
                'invoices',
                fn ($invoices) => $invoices->contains($myInvoiceA) &&
                ! $invoices->contains($otherUserInvoice) &&
                $invoices->contains($myInvoiceB)
            );
    }
}
<?php

namespace Tests\Unit\Listeners;

use App\Events\InvoiceApproved;
use App\Invoice;
use App\Notifications\InvoiceApprovedNotification;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SendInvoiceApprovedNotificationListenerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_sends_invoice_approved_notification()
    {
        Notification::fake();

        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        InvoiceApproved::dispatch($invoice);

        Notification::assertSentTo(
            $user,
            InvoiceApprovedNotification::class,
            fn (InvoiceApprovedNotification $notification) => $notification->invoice->is($invoice)
        );
    }
}

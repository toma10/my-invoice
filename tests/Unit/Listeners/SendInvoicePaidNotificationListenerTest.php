<?php

namespace Tests\Unit\Listeners;

use App\Events\InvoicePaid;
use App\Invoice;
use App\Notifications\InvoicePaidNotification;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SendInvoicePaidNotificationListenerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_sends_invoice_paid_notification()
    {
        Notification::fake();

        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        InvoicePaid::dispatch($invoice);

        Notification::assertSentTo(
            $user,
            InvoicePaidNotification::class,
            fn (InvoicePaidNotification $notification) => $notification->invoice->is($invoice)
        );
    }
}

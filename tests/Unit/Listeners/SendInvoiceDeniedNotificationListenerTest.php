<?php

namespace Tests\Unit\Listeners;

use App\Events\InvoiceDenied;
use App\Invoice;
use App\Notifications\InvoiceDeniedNotification;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SendInvoiceDeniedNotificationListenerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_sends_invoice_denied_notification()
    {
        Notification::fake();

        $user = factory(User::class)->create();
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        InvoiceDenied::dispatch($invoice);

        Notification::assertSentTo(
            $user,
            InvoiceDeniedNotification::class,
            fn (InvoiceDeniedNotification $notification) => $notification->invoice->is($invoice)
        );
    }
}

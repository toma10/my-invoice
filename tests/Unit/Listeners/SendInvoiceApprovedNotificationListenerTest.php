<?php

namespace Tests\Unit\Listeners;

use App\Events\InvoiceApproved;
use App\Invoice;
use App\Notifications\InvoiceApprovedNotification;
use App\NotificationsSetting;
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
        factory(NotificationsSetting::class)->create([
            'user_id' => $user,
            'invoice_approved' => true,
        ]);
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        InvoiceApproved::dispatch($invoice);

        Notification::assertSentTo(
            $user,
            InvoiceApprovedNotification::class,
            fn (InvoiceApprovedNotification $notification, $channels) => $notification->invoice->is($invoice) && $channels === ['mail']
        );
    }

    /** @test */
    public function user_can_disable_invoice_approved_notification()
    {
        Notification::fake();

        $user = factory(User::class)->create();
        factory(NotificationsSetting::class)->create([
            'user_id' => $user,
            'invoice_approved' => false,
        ]);
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        InvoiceApproved::dispatch($invoice);

        Notification::assertSentTo(
            $user,
            InvoiceApprovedNotification::class,
            fn ($_, $channels) => count($channels) === 0
        );
    }
}

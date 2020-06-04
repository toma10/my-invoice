<?php

namespace Tests\Unit\Listeners;

use App\Events\InvoiceDenied;
use App\Invoice;
use App\Notifications\InvoiceDeniedNotification;
use App\NotificationsSetting;
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
        factory(NotificationsSetting::class)->create([
            'user_id' => $user,
            'invoice_denied' => true,
        ]);
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        InvoiceDenied::dispatch($invoice);

        Notification::assertSentTo(
            $user,
            InvoiceDeniedNotification::class,
            fn (InvoiceDeniedNotification $notification, $channels) => $notification->invoice->is($invoice) && $channels === ['mail']
        );
    }

    /** @test */
    public function user_can_disable_invoice_denied_notification()
    {
        Notification::fake();

        $user = factory(User::class)->create();
        factory(NotificationsSetting::class)->create([
            'user_id' => $user,
            'invoice_denied' => false,
        ]);
        $invoice = factory(Invoice::class)->create(['user_id' => $user]);

        InvoiceDenied::dispatch($invoice);

        Notification::assertSentTo(
            $user,
            InvoiceDeniedNotification::class,
            fn ($_, $channels) => count($channels) === 0
        );
    }
}

<?php

namespace App\Listeners;

use App\Events\InvoicePaid;
use App\Notifications\InvoicePaidNotification;
use App\User;

class SendInvoicePaidNotificationListener
{
    public function handle(InvoicePaid $event): void
    {
        /** @var User $user */
        $user = $event->invoice->user;

        $user->notify(new InvoicePaidNotification($event->invoice));
    }
}

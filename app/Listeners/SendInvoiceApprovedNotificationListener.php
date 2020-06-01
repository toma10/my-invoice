<?php

namespace App\Listeners;

use App\Events\InvoiceApproved;
use App\Notifications\InvoiceApprovedNotification;
use App\User;

class SendInvoiceApprovedNotificationListener
{
    public function handle(InvoiceApproved $event): void
    {
        /** @var User $user */
        $user = $event->invoice->user;

        $user->notify(new InvoiceApprovedNotification($event->invoice));
    }
}

<?php

namespace App\Listeners;

use App\Events\InvoiceDenied;
use App\Notifications\InvoiceDeniedNotification;
use App\User;

class SendInvoiceDeniedNotificationListener
{
    public function handle(InvoiceDenied $event): void
    {
        /** @var User $user */
        $user = $event->invoice->user;

        $user->notify(new InvoiceDeniedNotification($event->invoice));
    }
}

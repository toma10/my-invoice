<?php

namespace App\Listeners;

use App\Events\UserActivated;
use App\Notifications\AccountActivatedNotification;

class SendAccountActivatedNotificationListener
{
    public function handle(UserActivated $event): void
    {
        $event->user->notify(new AccountActivatedNotification());
    }
}

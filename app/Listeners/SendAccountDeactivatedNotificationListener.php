<?php

namespace App\Listeners;

use App\Events\UserDeactivated;
use App\Notifications\AccountDeactivatedNotification;

class SendAccountDeactivatedNotificationListener
{
    public function handle(UserDeactivated $event): void
    {
        $event->user->notify(new AccountDeactivatedNotification());
    }
}

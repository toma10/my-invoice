<?php

namespace App\Listeners;

use App\Events\UserInvited;
use App\Notifications\WelcomeNotification;

class SendWelcomeNotificationListener
{
    public function handle(UserInvited $event): void
    {
        $event->user->notify(new WelcomeNotification());
    }
}

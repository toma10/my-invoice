<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

class AccountDeactivatedNotification extends Notification
{
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Account deactivated')
            ->line('Your account has been deactivated. You cannot use our application from now on!');
    }
}

<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

class AccountActivatedNotification extends Notification
{
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Account activated')
            ->line('Your account was activated. You can now log in.')
            ->action('Login', route('login'))
            ->line('Thank you for using our application!');
    }
}

<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

class WelcomeNotification extends Notification
{
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject(sprintf('Welcome to %s', config('app.name')))
            ->line(
                sprintf(
                    "You've been invited to use %s. You can setup your account using button below.",
                    config('app.name')
                )
            )
            ->action('Setup my account', url(route('users.welcome', $notifiable->token)))
            ->line('Thank you for using our application!');
    }
}

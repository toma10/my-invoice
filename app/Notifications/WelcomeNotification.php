<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

class WelcomeNotification extends Notification
{
    /**
     * @param  mixed $notifiable
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
            ->line(
                sprintf(
                    "You 've been invited to use %s. You can setup your account using button below.",
                    config('app.name')
                )
            )
            ->action('Setup my account', url(route('users.welcome', $notifiable->token)))
            ->line('Thank you for using our application!');
    }
}

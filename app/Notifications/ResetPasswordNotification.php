<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    protected string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
            ->subject('Reset Password')
            ->line("You've requested reset password. Here is yout reset password link. Link will expire in 24 hours.")
            ->action('Reset Password', url($this->url))
            ->line('Thank you for using our application!');
    }
}

<?php

namespace App\Notifications;

use App\NotificationsSetting;
use App\User;

trait OptOutable
{
    /**
     * @param  mixed  $notifiable
     */
    public function via($notifiable): array
    {
        if ($this->optOut($notifiable)) {
            return [];
        }

        return ['mail'];
    }

    /**
     * @param  mixed  $notifiable
     */
    protected function optOut($notifiable): bool
    {
        if (! ($notifiable instanceof User)) {
            return false;
        }

        $notificationsSetting = NotificationsSetting::forUser($notifiable);

        return ! ($notificationsSetting[$this->settingsKeyName()] ?? true);
    }

    abstract protected function settingsKeyName();
}

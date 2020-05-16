<?php

namespace App\Providers;

use App\Events\UserInvited;
use App\Listeners\SendWelcomeNotificationListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserInvited::class => [
            SendWelcomeNotificationListener::class,
        ],
    ];
}

<?php

namespace App\Providers;

use App\Events\InvoiceApproved;
use App\Events\InvoiceDenied;
use App\Events\UserInvited;
use App\Listeners\SendInvoiceApprovedNotificationListener;
use App\Listeners\SendInvoiceDeniedNotificationListener;
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
        InvoiceApproved::class => [
            SendInvoiceApprovedNotificationListener::class,
        ],
        InvoiceDenied::class => [
            SendInvoiceDeniedNotificationListener::class,
        ],
    ];
}

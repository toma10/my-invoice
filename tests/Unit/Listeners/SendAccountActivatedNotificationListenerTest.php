<?php

namespace Tests\Unit\Listeners;

use App\Events\UserActivated;
use App\Notifications\AccountActivatedNotification;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SendAccountActivatedNotificationListenerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_sends_user_activated_notification()
    {
        Notification::fake();

        $user = factory(User::class)->create();

        UserActivated::dispatch($user);

        Notification::assertSentTo(
            $user,
            AccountActivatedNotification::class,
        );
    }
}

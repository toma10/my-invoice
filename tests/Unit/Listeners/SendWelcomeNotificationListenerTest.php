<?php

namespace Tests\Unit\Listeners;

use App\User;
use Tests\TestCase;
use App\Events\UserInvited;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendWelcomeNotificationListenerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_sends_welcome_notification()
    {
        Notification::fake();

        $user = User::invite('johndoe@example.com', 'token');

        UserInvited::dispatch($user);

        Notification::assertSentTo($user, WelcomeNotification::class);
    }
}

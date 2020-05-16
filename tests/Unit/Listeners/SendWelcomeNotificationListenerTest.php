<?php

namespace Tests\Unit\Listeners;

use App\Events\UserInvited;
use App\Notifications\WelcomeNotification;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

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

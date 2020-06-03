<?php

namespace Tests\Unit\Listeners;

use App\Events\UserDeactivated;
use App\Notifications\AccountDeactivatedNotification;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SendAccountDeactivatedNotificationListenerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_sends_user_deactivated_notification()
    {
        Notification::fake();

        $user = factory(User::class)->create();

        UserDeactivated::dispatch($user);

        Notification::assertSentTo(
            $user,
            AccountDeactivatedNotification::class,
        );
    }
}

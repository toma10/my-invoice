<?php

namespace Tests\Feature;

use App\NotificationsSetting;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateNotificationsSettingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_must_be_logged_in()
    {
        $this->post('notifications-settings')->assertRedirect('login');
    }

    /** @test */
    public function successfully_updating_notifications_setting()
    {
        $user = factory(User::class)->create();
        $notificationsSetting = factory(NotificationsSetting::class)->create([
            'user_id' => $user->id,
            'invoice_approved' => false,
            'invoice_paid' => true,
            'invoice_denied' => false,
        ]);

        $response = $this
            ->from('profile/edit')
            ->actingAs($user)
            ->post('notifications-settings', [
                'invoice_approved' => 'on',
                'invoice_denied' => 'on',
            ]);

        $response->assertRedirect('profile/edit');
        $response->assertSessionHasFlashMessage('success');
        tap($notificationsSetting->fresh(), function (NotificationsSetting $notificationsSetting) {
            $this->assertTrue($notificationsSetting->invoice_approved);
            $this->assertFalse($notificationsSetting->invoice_paid);
            $this->assertTrue($notificationsSetting->invoice_denied);
        });
    }
}

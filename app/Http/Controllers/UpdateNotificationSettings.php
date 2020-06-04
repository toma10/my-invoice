<?php

namespace App\Http\Controllers;

use App\NotificationsSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UpdateNotificationSettings
{
    public function __invoke(Request $request): RedirectResponse
    {
        $notificationsSetting = NotificationsSetting::forUser($request->user());

        $data = collect([
            'invoice_approved' => true,
            'invoice_paid' => true,
            'invoice_denied' => true,
        ])->map(fn ($value, $key) => $request->has($key));

        $notificationsSetting->update($data->toArray());

        flash()->success(trans('messages.notificationsSetting.updated'));

        return back();
    }
}

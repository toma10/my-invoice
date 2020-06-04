<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditProfileRequest;
use App\NotificationsSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController
{
    public function show(Request $request): View
    {
        $user = $request->user();

        return view('profile.show', compact('user'));
    }

    public function edit(Request $request): View
    {
        $user = $request->user();
        $notificationsSetting = NotificationsSetting::forUser($user);

        return view('profile.edit', compact('user', 'notificationsSetting'));
    }

    public function update(EditProfileRequest $request): RedirectResponse
    {
        $request->user()->update($request->validated());

        flash()->success(trans('messages.profile.updated'));

        return back();
    }
}

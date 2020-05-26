<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestResetPasswordRequest;
use App\Notifications\ResetPasswordNotification;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\URL;

class RequestResetPasswordController
{
    public function __invoke(RequestResetPasswordRequest $request): RedirectResponse
    {
        $user = User::findByEmail($request->email);

        $url = URL::temporarySignedRoute('password.reset', now()->addDay(), ['email' => $user->email]);

        $user->notify(new ResetPasswordNotification($url));

        flash()->success(trans('passwords.sent'));

        return back();
    }
}

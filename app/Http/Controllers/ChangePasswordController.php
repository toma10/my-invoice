<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\RedirectResponse;

class ChangePasswordController
{
    public function __invoke(ChangePasswordRequest $request): RedirectResponse
    {
        $request->user()->update(['password' => bcrypt($request->password)]);

        flash()->success(trans('messages.profile.password_changed'));

        return back();
    }
}

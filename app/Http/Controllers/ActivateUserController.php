<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ActivateUserController
{
    public function __invoke(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = User::findOrFail($request->user_id);

        $user->activate();

        flash()->success(trans('messages.users.activated'));

        return back();
    }
}

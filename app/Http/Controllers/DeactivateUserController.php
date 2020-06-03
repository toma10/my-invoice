<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeactivateUserController
{
    public function __invoke(Request $request): RedirectResponse
    {
        /** @var User $user */
        $user = User::findOrFail($request->user_id);

        $user->deactivate();

        flash()->success(trans('messages.users.deactivated'));

        return back();
    }
}

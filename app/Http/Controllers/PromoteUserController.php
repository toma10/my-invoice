<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PromoteUserController
{
    public function __invoke(Request $request): RedirectResponse
    {
        $user = User::findOrFail($request->user_id);

        $user->update(['is_admin' => true]);

        flash()->success(trans('messages.users.promoted'));

        return back();
    }
}

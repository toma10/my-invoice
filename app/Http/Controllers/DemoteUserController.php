<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DemoteUserController
{
    public function __invoke(Request $request): RedirectResponse
    {
        $user = User::findOrFail($request->user_id);

        $user->update(['is_admin' => false]);

        flash()->success(trans('messages.users.demoted'));

        return back();
    }
}

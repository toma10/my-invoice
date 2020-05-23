<?php

namespace App\Http\Controllers;

use App\Events\UserInvited;
use App\Http\Requests\InviteUserRequest;
use App\TokenGenerator;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class InviteUserController
{
    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(InviteUserRequest $request, TokenGenerator $tokenGenerator): RedirectResponse
    {
        $user = User::invite(
            $request->email,
            $tokenGenerator->generate()
        );

        UserInvited::dispatch($user);

        flash()->success(trans('messages.users.invited'));

        return back();
    }
}

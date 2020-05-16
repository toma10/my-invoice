<?php

namespace App\Http\Controllers;

use App\Events\UserInvited;
use App\Http\Requests\InviteUserRequest;
use App\TokenGenerator;
use App\User;
use Illuminate\Http\Response;

class InviteUserController
{
    public function __invoke(InviteUserRequest $request, TokenGenerator $tokenGenerator): Response
    {
        $user = User::invite(
            $request->email,
            $tokenGenerator->generate()
        );

        UserInvited::dispatch($user);

        return response([], Response::HTTP_CREATED);
    }
}

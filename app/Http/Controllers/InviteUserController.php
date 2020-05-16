<?php

namespace App\Http\Controllers;

use App\User;
use App\TokenGenerator;
use App\Events\UserInvited;
use Illuminate\Http\Response;
use App\Http\Requests\InviteUserRequest;

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

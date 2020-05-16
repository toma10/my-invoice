<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SetupAccountRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SetupAccountController
{
    public function __invoke(SetupAccountRequest $request): RedirectResponse
    {
        try {
            $user = User::findByEmail($request->email);
        } catch (ModelNotFoundException $e) {
            abort(Response::HTTP_BAD_REQUEST);
        }

        abort_if($user->token !== $request->token, Response::HTTP_BAD_REQUEST);

        $user->update([
            'password' => bcrypt($request->password),
            'token' => null,
        ]);

        Auth::login($user);

        return redirect()->route('invoices.index');
    }
}

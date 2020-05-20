<?php

namespace App\Http\Controllers;

use App\Http\Requests\SetupAccountRequest;
use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class SetupAccountController
{
    public function __invoke(SetupAccountRequest $request): RedirectResponse
    {
        try {
            $user = User::findByEmail($request->email);
        } catch (ModelNotFoundException $exception) {
            abort(Response::HTTP_BAD_REQUEST);
        }

        abort_if($user->token !== $request->token, Response::HTTP_BAD_REQUEST);

        $user->update([
            'password' => bcrypt($request->password),
            'token' => null,
        ]);

        Auth::login($user);

        flash()->success(trans('messages.account.activated'));

        return redirect()->route('invoices.index');
    }
}

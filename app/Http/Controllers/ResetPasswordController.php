<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ResetPasswordController
{
    public function show(string $email): View
    {
        return view('auth.passwords.reset', compact('email'));
    }

    public function store(ResetPasswordRequest $request): RedirectResponse
    {
        $user = User::findByEmail($request->email);

        $user->update(['password' => bcrypt($request->password)]);

        Auth::login($user);

        flash()->success('passwords.reset');

        return redirect()->route('invoices.index');
    }
}

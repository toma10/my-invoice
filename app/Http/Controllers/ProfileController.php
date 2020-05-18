<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController
{
    public function show(Request $request): View
    {
        $user = $request->user();

        return view('profile.show', compact('user'));
    }
}

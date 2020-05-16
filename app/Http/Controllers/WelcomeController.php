<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class WelcomeController
{
    public function __invoke(Request $request): View
    {
        $token = $request->token;

        return view('welcome', compact('token'));
    }
}

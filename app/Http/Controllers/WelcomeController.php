<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class WelcomeController
{
    public function __invoke(Request $request): View
    {
        $token = $request->token;

        return view('welcome', compact('token'));
    }
}

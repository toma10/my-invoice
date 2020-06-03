<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\View\View;

class ShowUserController
{
    public function __invoke(User $user): View
    {
        return view('admin.users.show', compact('user'));
    }
}

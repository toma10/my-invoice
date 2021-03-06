<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\View\View;

class ListUsersController
{
    public function __invoke(): View
    {
        $users = User::orderBy('id')->paginate();

        return view('admin.users.index', compact('users'));
    }
}

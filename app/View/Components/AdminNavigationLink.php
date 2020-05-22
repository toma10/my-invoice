<?php

namespace App\View\Components;

use Illuminate\View\View;

class AdminNavigationLink extends BaseNavigationLink
{
    public function render(): View
    {
        return view('components.admin-navigation-link');
    }
}

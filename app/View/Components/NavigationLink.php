<?php

namespace App\View\Components;

use Illuminate\View\View;

class NavigationLink extends BaseNavigationLink
{
    public function render(): View
    {
        return view('components.navigation-link');
    }
}

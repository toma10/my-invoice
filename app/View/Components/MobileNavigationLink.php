<?php

namespace App\View\Components;

use Illuminate\View\View;

class MobileNavigationLink extends BaseNavigationLink
{
    public function render(): View
    {
        return view('components.mobile-navigation-link');
    }
}

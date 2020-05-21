<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\View\View;

class NavigationLink extends Component
{
    public string $href;

    public function __construct(string $href)
    {
        $this->href = $href;
    }

    public function render(): View
    {
        return view('components.navigation-link');
    }

    public function isActive(): bool
    {
        return Str::startsWith(request()->url(), $this->href);
    }
}

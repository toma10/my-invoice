<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\View\View;

class AdminNavigationLink extends Component
{
    public string $href;

    protected bool $exact;

    public function __construct(string $href, bool $exact = false)
    {
        $this->href = $href;
        $this->exact = $exact;
    }

    public function render(): View
    {
        return view('components.admin-navigation-link');
    }

    public function isActive(): bool
    {
        if ($this->exact) {
            return request()->url() === $this->href;
        }

        return Str::startsWith(request()->url(), $this->href);
    }
}

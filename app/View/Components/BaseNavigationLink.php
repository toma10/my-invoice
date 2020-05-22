<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

abstract class BaseNavigationLink extends Component
{
    public string $href;

    protected bool $exact;

    public function __construct(string $href, bool $exact = false)
    {
        $this->href = $href;
        $this->exact = $exact;
    }

    abstract public function render();

    public function isActive(): bool
    {
        if ($this->exact) {
            return request()->url() === $this->href;
        }

        return Str::startsWith(request()->url(), $this->href);
    }
}

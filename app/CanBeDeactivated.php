<?php

namespace App;

use App\Events\UserActivated;
use App\Events\UserDeactivated;

trait CanBeDeactivated
{
    public function deactivate(): void
    {
        $this->update(['deactivated_at' => now()]);

        event(new UserDeactivated($this));
    }

    public function activate(): void
    {
        $this->update(['deactivated_at' => null]);

        event(new UserActivated($this));
    }

    public function isActive(): bool
    {
        return $this->deactivated_at === null;
    }
}

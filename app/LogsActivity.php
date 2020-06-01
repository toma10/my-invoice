<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Spatie\Activitylog\Models\Activity;

trait LogsActivity
{
    public function logActivity(string $type, User $user): void
    {
        activity()
            ->performedOn($this)
            ->causedBy($user)
            ->log($type);
    }

    public function activity(): MorphMany
    {
        return $this->morphMany(Activity::class, 'subject');
    }
}

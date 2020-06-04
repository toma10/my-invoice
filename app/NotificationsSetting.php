<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NotificationsSetting extends Model
{
    public $timestamps = false;

    protected $casts = [
        'invoice_approved' => 'bool',
        'invoice_paid' => 'bool',
        'invoice_denied' => 'bool',
    ];

    public static function forUser(User $user): NotificationsSetting
    {
        return static::firstOrCreate(['user_id' => $user->id]);
    }
}

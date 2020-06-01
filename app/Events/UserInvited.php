<?php

namespace App\Events;

use App\User;

class UserInvited extends Event
{
    public User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}

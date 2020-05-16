<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $casts = [
        'is_admin' => 'bool',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public static function findByEmail(string $email): User
    {
        return static::where(compact('email'))->firstOrFail();
    }

    public static function invite(string $email, string $token): User
    {
        return User::create(compact('email', 'token'));
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }
}

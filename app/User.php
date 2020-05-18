<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function avatarUrl(int $size = 80): string
    {
        return sprintf(
            'https://www.gravatar.com/avatar/%s?d=mp&s=%d',
            md5(strtolower(trim($this->email))),
            $size
        );
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function addInvoice(Invoice $invoice): void
    {
        $this->invoices()->save($invoice);
    }

    public function isOwnerOf(Invoice $invoice): bool
    {
        return $this->invoices->contains($invoice);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }
}

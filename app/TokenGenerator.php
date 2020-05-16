<?php

namespace App;

class TokenGenerator
{
    protected const TOKEN_LENGTH = 64;

    public function generate(): string
    {
        $pool = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, self::TOKEN_LENGTH)), 0, self::TOKEN_LENGTH);
    }
}

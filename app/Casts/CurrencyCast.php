<?php

namespace App\Casts;

use App\Currency;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class CurrencyCast implements CastsAttributes
{
    public function get($model, $key, $value, $attributes): ?Currency
    {
        if ($value === null) {
            return null;
        }

        return new Currency($value);
    }

    public function set($model, $key, $value, $attributes): string
    {
        return (string) $value;
    }
}

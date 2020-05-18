<?php

namespace App\Rules;

use App\Currency;
use Illuminate\Contracts\Validation\Rule;

class CurrencyRule implements Rule
{
    public function passes($attribute, $key): bool
    {
        return Currency::isValidKey($key);
    }

    public function message(): string
    {
        return trans('validation.currency');
    }
}

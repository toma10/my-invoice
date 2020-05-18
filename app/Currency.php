<?php

namespace App;

use App\Casts\CurrencyCast;
use Illuminate\Contracts\Database\Eloquent\Castable;
use MyCLabs\Enum\Enum;

/**
 * @method static self CZK()
 * @method static self USD()
 * @method static self EUR()
 */
class Currency extends Enum implements Castable
{
    private const CZK = 'CZK';

    private const USD = 'USD';

    private const EUR = 'EUR';

    public static function castUsing()
    {
        return CurrencyCast::class;
    }
}

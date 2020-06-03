<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class Status extends Model
{
    use Sushi;

    public const CREATED = 'created';

    public const APPROVED = 'approved';

    public const PAID = 'paid';

    public const DENIED = 'denied';

    /**
     * @var array
     */
    protected $rows = [
        [
            'name' => self::CREATED,
            'label' => 'Created',
            'color' => 'blue',
        ],
        [
            'name' => self::APPROVED,
            'label' => 'Approved',
            'color' => 'green',
        ],
        [
            'name' => self::PAID,
            'label' => 'Paid',
            'color' => 'blue',
        ],
        [
            'name' => self::DENIED,
            'label' => 'Denied',
            'color' => 'red',
        ],
    ];

    public static function fromName(string $name): Status
    {
        return static::whereName($name)->firstOrFail();
    }
}

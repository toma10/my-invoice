<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sushi\Sushi;

class InvoiceStatus extends Model
{
    use Sushi;

    /**
     * @var array
     */
    protected $rows = [
        [
            'name' => 'created',
            'label' => 'Created',
            'color' => 'blue',
        ],
        [
            'name' => 'approved',
            'label' => 'Approved',
            'color' => 'green',
        ],
        [
            'name' => 'denied',
            'label' => 'Denied',
            'color' => 'red',
        ],
    ];

    public static function fromName(string $name): InvoiceStatus
    {
        return static::whereName($name)->firstOrFail();
    }
}

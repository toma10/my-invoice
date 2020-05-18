<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $casts = [
        'currency' => Currency::class,
        'price' => 'float',
    ];

    protected $dates = [
        'period',
        'invoice_date',
        'date_of_taxable_supply',
        'due_date',
    ];
}

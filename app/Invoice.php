<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasStatus, LogsActivity;

    protected $perPage = 20;

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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}

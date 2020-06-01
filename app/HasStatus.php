<?php

namespace App;

use App\Events\InvoiceApproved;
use App\Events\InvoiceCreated;
use App\Events\InvoiceDenied;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasStatus
{
    public static function bootHasStatus(): void
    {
        static::creating(function (Invoice $invoice) {
            $invoice->status_id = InvoiceStatus::fromName('created')->id;
        });

        static::created(function (Invoice $invoice) {
            event(new InvoiceCreated($invoice));
        });
    }

    public function approve(): void
    {
        $this->update(['status_id' => InvoiceStatus::fromName('approved')->id]);

        event(new InvoiceApproved($this));
    }

    public function deny(): void
    {
        $this->update(['status_id' => InvoiceStatus::fromName('denied')->id]);

        event(new InvoiceDenied($this));
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(InvoiceStatus::class);
    }
}

<?php

namespace App;

use App\Events\InvoiceApproved;
use App\Events\InvoiceCreated;
use App\Events\InvoiceDenied;
use App\Events\InvoicePaid;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasStatus
{
    public static function bootHasStatus(): void
    {
        static::creating(function (Invoice $invoice) {
            $invoice->status_id = Status::fromName(Status::CREATED)->id;
        });

        static::created(function (Invoice $invoice) {
            event(new InvoiceCreated($invoice));
        });
    }

    public function hasStatus(string $status): bool
    {
        return optional($this->status)->name === $status;
    }

    public function approve(): void
    {
        if ($this->hasStatus(Status::PAID) || $this->hasStatus(Status::DENIED)) {
            throw new InvalidStatusTransitionException();
        }

        $this->update(['status_id' => Status::fromName(Status::APPROVED)->id]);

        event(new InvoiceApproved($this));
    }

    public function pay(): void
    {
        if ($this->hasStatus(Status::CREATED) || $this->hasStatus(Status::DENIED)) {
            throw new InvalidStatusTransitionException();
        }

        $this->update(['status_id' => Status::fromName(Status::PAID)->id]);

        event(new InvoicePaid($this));
    }

    public function deny(): void
    {
        if ($this->hasStatus(Status::PAID)) {
            throw new InvalidStatusTransitionException();
        }

        $this->update(['status_id' => Status::fromName(Status::DENIED)->id]);

        event(new InvoiceDenied($this));
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }
}

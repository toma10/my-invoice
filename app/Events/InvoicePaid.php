<?php

namespace App\Events;

use App\Invoice;

class InvoicePaid extends Event
{
    public Invoice $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }
}

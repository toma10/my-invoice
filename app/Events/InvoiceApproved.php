<?php

namespace App\Events;

use App\Invoice;

class InvoiceApproved extends Event
{
    public Invoice $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }
}

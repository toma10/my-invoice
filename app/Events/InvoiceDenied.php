<?php

namespace App\Events;

use App\Invoice;

class InvoiceDenied extends Event
{
    public Invoice $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }
}

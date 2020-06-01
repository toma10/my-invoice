<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\View\View;

class ShowInvoiceController
{
    public function __invoke(Invoice $invoice): View
    {
        return view('admin.invoices.show', compact('invoice'));
    }
}

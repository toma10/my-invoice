<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\View\View;

class ListInvoicesController
{
    public function __invoke(): View
    {
        $invoices = Invoice::latest()->paginate();

        return view('admin.invoices.index', compact('invoices'));
    }
}

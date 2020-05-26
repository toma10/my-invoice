<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

class ListInvoicesController
{
    public function __invoke(Request $request)
    {
        $invoices = Invoice::all();

        return view('admin.invoices.index', compact('invoices'));
    }
}

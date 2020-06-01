<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DenyInvoiceController
{
    public function __invoke(Request $request): RedirectResponse
    {
        /** @var Invoice $invoice */
        $invoice = Invoice::findOrFail($request->invoice_id);

        $invoice->deny();

        flash()->success(trans('messages.invoice.denied'));

        return back();
    }
}

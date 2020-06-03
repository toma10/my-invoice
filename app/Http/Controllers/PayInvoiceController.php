<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\InvoiceActivityTypes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PayInvoiceController
{
    public function __invoke(Request $request): RedirectResponse
    {
        /** @var Invoice $invoice */
        $invoice = Invoice::findOrFail($request->invoice_id);

        $invoice->pay();

        $invoice->logActivity(InvoiceActivityTypes::PAID, $request->user());

        flash()->success(trans('messages.invoice.paid'));

        return back();
    }
}

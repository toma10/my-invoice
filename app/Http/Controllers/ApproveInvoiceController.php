<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ApproveInvoiceController
{
    public function __invoke(Request $request): RedirectResponse
    {
        /** @var Invoice $invoice */
        $invoice = Invoice::findOrFail($request->invoice_id);

        $invoice->approve();

        flash()->success(trans('messages.invoice.approved'));

        return back();
    }
}

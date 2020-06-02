<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\InvoiceActivityTypes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApproveInvoiceController
{
    public function __invoke(Request $request): RedirectResponse
    {
        /** @var Invoice $invoice */
        $invoice = Invoice::findOrFail($request->invoice_id);

        abort_if($invoice->isClosed(), Response::HTTP_FORBIDDEN);

        $invoice->approve();

        $invoice->logActivity(InvoiceActivityTypes::APPROVED, $request->user());

        flash()->success(trans('messages.invoice.approved'));

        return back();
    }
}

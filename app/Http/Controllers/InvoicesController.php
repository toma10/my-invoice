<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\InvoiceRequest;
use App\Invoice;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class InvoicesController
{
    public function create(): View
    {
        $departments = Department::pluck('name', 'id')->toArray();

        return view('invoices.create', compact('departments'));
    }

    public function store(InvoiceRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $pdf = $data['pdf_file'];
        Arr::forget($data, 'pdf_file');

        $invoice = Invoice::make(
            array_merge($data, [
                'pdf_file_filename' => $pdf->getClientOriginalName(),
                'pdf_file_path' => $pdf->store('invoices'),
            ])
        );

        $request->user()->addInvoice($invoice);

        return redirect()->route('invoices.show', $invoice);
    }

    public function show(Request $request, Invoice $invoice): View
    {
        abort_if(! $request->user()->isOwnerOf($invoice), Response::HTTP_NOT_FOUND);

        return view('invoices.show', compact('invoice'));
    }
}

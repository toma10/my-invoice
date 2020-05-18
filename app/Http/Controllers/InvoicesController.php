<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Invoice;
use App\ViewModels\InvoiceViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class InvoicesController
{
    public function create(): View
    {
        $viewModel = new InvoiceViewModel();

        return view('invoices.create', $viewModel);
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

    public function show(Invoice $invoice): View
    {
        return view('invoices.show', compact('invoice'));
    }
}

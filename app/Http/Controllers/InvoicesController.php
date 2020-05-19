<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Invoice;
use App\ViewModels\InvoiceViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class InvoicesController
{
    public function index(Request $request): View
    {
        $invoices = $request->user()->invoices;

        return view('invoices.index', compact('invoices'));
    }

    public function create(): View
    {
        $viewModel = new InvoiceViewModel();

        return view('invoices.create', $viewModel);
    }

    public function store(InvoiceRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $pdf = $data['pdf_file'];
        $data = Arr::except($data, 'pdf_file');

        $data += [
            'pdf_file_filename' => $pdf->getClientOriginalName(),
            'pdf_file_path' => $pdf->store('invoices'),
        ];

        $request->user()->addInvoice(
            $invoice = Invoice::make($data)
        );

        return redirect()->route('invoices.show', $invoice);
    }

    public function show(Invoice $invoice): View
    {
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice): View
    {
        $viewModel = new InvoiceViewModel($invoice);

        return view('invoices.edit', $viewModel);
    }

    public function update(InvoiceRequest $request, Invoice $invoice): RedirectResponse
    {
        $data = $request->validated();

        if (isset($data['pdf_file'])) {
            $pdf = $data['pdf_file'];

            $data += [
                'pdf_file_filename' => $pdf->getClientOriginalName(),
                'pdf_file_path' => $pdf->store('invoices'),
            ];

            Storage::delete($invoice->pdf_file_path);
        }

        $data = Arr::except($data, 'pdf_file');
        $invoice->update($data);

        return redirect()->route('invoices.show', $invoice);
    }

    public function destroy(Invoice $invoice): RedirectResponse
    {
        Storage::delete($invoice->pdf_file_path);
        $invoice->delete();

        return redirect()->route('invoices.index');
    }
}

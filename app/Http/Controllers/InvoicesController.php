<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Invoice;
use App\InvoiceActivityTypes;
use App\Status;
use App\ViewModels\InvoiceViewModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class InvoicesController
{
    public function index(Request $request): View
    {
        $invoices = Invoice::where('user_id', $request->user()->id)
            ->latest()
            ->paginate();

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

        $invoice->logActivity(InvoiceActivityTypes::CREATED, $request->user());

        flash()->success(trans('messages.invoice.created'));

        return redirect()->route('invoices.show', $invoice);
    }

    public function show(Invoice $invoice): View
    {
        $activityLog = $invoice->activity()->latest()->get();

        return view('invoices.show', compact('invoice', 'activityLog'));
    }

    public function edit(Invoice $invoice): View
    {
        abort_unless($invoice->hasStatus(Status::CREATED), Response::HTTP_FORBIDDEN);

        $viewModel = new InvoiceViewModel($invoice);

        return view('invoices.edit', $viewModel);
    }

    public function update(InvoiceRequest $request, Invoice $invoice): RedirectResponse
    {
        abort_unless($invoice->hasStatus(Status::CREATED), Response::HTTP_FORBIDDEN);

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

        flash()->success(trans('messages.invoice.updated'));

        return redirect()->route('invoices.show', $invoice);
    }

    public function destroy(Invoice $invoice): RedirectResponse
    {
        abort_unless($invoice->hasStatus(Status::CREATED), Response::HTTP_FORBIDDEN);

        Storage::delete($invoice->pdf_file_path);
        $invoice->delete();

        flash()->success(trans('messages.invoice.deleted'));

        return redirect()->route('invoices.index');
    }
}

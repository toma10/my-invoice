<?php

namespace App\Http\Controllers;

use App\Department;
use App\Http\Requests\InvoiceRequest;
use App\Invoice;
use Illuminate\Http\RedirectResponse;
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

        $invoice = Invoice::create(
            array_merge($data, [
                'pdf_file_filename' => $pdf->getClientOriginalName(),
                'pdf_file_path' => $pdf->store('invoices'),
            ])
        );

        return redirect()->route('invoices.show', $invoice);
    }
}

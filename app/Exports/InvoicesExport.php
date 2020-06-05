<?php

namespace App\Exports;

use App\Invoice;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class InvoicesExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    public function collection(): Collection
    {
        return Invoice::with('user', 'department')->latest()->get();
    }

    public function headings(): array
    {
        return [
            'Id',
            'User',
            'Department',
            'Company Registration Number',
            'Period',
            'Invoice Date',
            'Date of Taxable Supply',
            'Due Date',
            'Variable Symbol',
            'Constant Symbol',
            'Hours',
            'Price',
            'Currency',
            'Status',
            'Description',
            'Note',
        ];
    }

    public function map($row): array
    {
        return [
            $row->id,
            optional($row->user)->name,
            optional($row->department)->name,
            $row->company_registration_number,
            $row->period->format('M, Y'),
            $row->invoice_date->toDateString(),
            $row->date_of_taxable_supply->toDateString(),
            $row->due_date->toDateString(),
            $row->variable_symbol,
            $row->constant_symbol,
            $row->hours,
            $row->price,
            $row->currency,
            optional($row->status)->label,
            $row->description,
            $row->note,
        ];
    }
}

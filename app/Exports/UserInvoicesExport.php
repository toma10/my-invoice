<?php

namespace App\Exports;

use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserInvoicesExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    protected User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function collection(): Collection
    {
        return $this->user->invoices()->with('department')->get();
    }

    public function headings(): array
    {
        return [
            'Id',
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

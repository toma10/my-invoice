<?php

namespace App\ViewModels;

use App\Department;
use App\Invoice;
use Spatie\ViewModels\ViewModel;

class InvoiceViewModel extends ViewModel
{
    protected ?Invoice $invoice;

    public function __construct(?Invoice $invoice = null)
    {
        $this->invoice = $invoice;
    }

    public function invoice(): Invoice
    {
        return $this->invoice ?? new Invoice();
    }

    public function departments(): array
    {
        return Department::pluck('name', 'id')->toArray();
    }
}

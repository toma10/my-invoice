<?php

namespace App\Http\Requests;

use App\Rules\CurrencyRule;
use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'company_registration_number' => ['required'],
            'department_id' => ['required', 'exists:departments,id'],
            'period' => ['required', 'date'],
            'invoice_date' => ['required', 'date'],
            'date_of_taxable_supply' => ['required', 'date'],
            'due_date' => ['required', 'date'],
            'price' => ['required', 'numeric', 'min:0'],
            'currency' => ['required', new CurrencyRule()],
            'hours' => ['required', 'integer', 'min:0'],
            'variable_symbol' => ['required'],
            'constant_symbol' => ['nullable'],
            'pdf_file' => ['required', 'file', 'mimes:pdf'],
            'description' => ['required'],
            'note' => ['nullable'],
        ];
    }
}

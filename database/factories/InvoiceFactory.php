<?php

use App\Department;
use App\Invoice;
use App\User;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'company_registration_number' => '01234567',
        'user_id' => factory(User::class),
        'department_id' => factory(Department::class),
        'period' => '2020-05',
        'invoice_date' => '2020-04-30',
        'date_of_taxable_supply' => '2020-04-30',
        'due_date' => '2020-05-15',
        'price' => '30000',
        'currency' => 'CZK',
        'hours' => '160',
        'variable_symbol' => '2020005',
        'constant_symbol' => '123',
        'description' => 'Invoice for 05/2020.',
        'pdf_file_path' => 'invoices/0792f6b016af4fb5bc66f087d07fe24a.pdf',
        'pdf_file_filename' => 'invoice.pdf',
        'note' => 'Refactoring + design',
    ];
});

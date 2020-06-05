<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportInvoicesController
{
    /**
     * @return Response|BinaryFileResponse
     */
    public function __invoke()
    {
        return (new InvoicesExport())->download('invoices.xlsx');
    }
}

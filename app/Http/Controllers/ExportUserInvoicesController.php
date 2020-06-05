<?php

namespace App\Http\Controllers;

use App\Exports\UserInvoicesExport;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportUserInvoicesController
{
    /**
     * @return Response|BinaryFileResponse
     */
    public function __invoke(Request $request)
    {
        return (new UserInvoicesExport($request->user()))->download('invoices.xlsx');
    }
}

<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DownloadInvoiceController
{
    public function __invoke(Request $request, Invoice $invoice): StreamedResponse
    {
        abort_if(! $request->user()->isOwnerOf($invoice), Response::HTTP_NOT_FOUND);

        return Storage::download($invoice->pdf_file_path, $invoice->pdf_file_filename);
    }
}

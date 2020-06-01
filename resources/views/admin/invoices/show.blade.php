@extends('layouts.app')

@section('content')
<x-page-header>
  <div class="flex items-center space-x-3">
    <x-page-title>Invoice {{ $invoice->variable_symbol }}</x-page-title>
    <x-invoice-status :status="$invoice->status" size="md" />
  </div>
</x-page-header>

<div class="mt-12">
  @include('invoices.partials._basicInformation')

  @if($invoice->status->name === 'created')
    <div class="mt-8 border-t border-gray-200 pt-5">
      <div class="flex justify-end space-x-3">
        <x-form :action="route('admin.denyInvoice', $invoice)" class="inline-flex">
          <x-hidden-field name="invoice_id" :value="$invoice->id" />
          <x-button variant="danger">Deny</x-button>
        </x-form>
        <x-form :action="route('admin.approveInvoice')" class="inline-flex">
          <x-hidden-field name="invoice_id" :value="$invoice->id" />
          <x-button>Approve</x-button>
        </x-form>
      </div>
    @endif
  </div>
@endsection

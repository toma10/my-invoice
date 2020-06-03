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

  @if ($invoice->status->name === \App\Status::CREATED)
    <div class="mt-8 border-t border-gray-200 pt-5">
      <div class="flex justify-end space-x-3">
        <x-confirm-modal
          :action="route('admin.denyInvoice')"
          title="Deny Invoice"
          body="Are you sure you want to deny invoice? This action cannot be undone."
        >
          <x-hidden-field name="invoice_id" :value="$invoice->id" />
          <x-button type="button" variant="plain" @click="$dispatch('open')">Deny</x-button>
        </x-confirm-modal>
        <x-confirm-modal
          :action="route('admin.approveInvoice')"
          title="Approve Invoice"
          body="Are you sure you want to approve invoice? This action cannot be undone."
        >
          <x-hidden-field name="invoice_id" :value="$invoice->id" />
          <x-button type="button" @click="$dispatch('open')">Approve</x-button>
        </x-confirm-modal>
      </div>
    @endif

  @if ($invoice->status->name === \App\Status::APPROVED)
    <div class="mt-8 border-t border-gray-200 pt-5">
      <div class="flex justify-end space-x-3">
        <x-confirm-modal
          :action="route('admin.denyInvoice')"
          title="Deny Invoice"
          body="Are you sure you want to deny invoice? This action cannot be undone."
        >
          <x-hidden-field name="invoice_id" :value="$invoice->id" />
          <x-button type="button" variant="plain" @click="$dispatch('open')">Deny</x-button>
        </x-confirm-modal>
        <x-confirm-modal
          :action="route('admin.payInvoice')"
          title="Pay Invoice"
          body="Are you sure you want to pay invoice? This action cannot be undone."
        >
          <x-hidden-field name="invoice_id" :value="$invoice->id" />
          <x-button type="button" @click="$dispatch('open')">Pay</x-button>
        </x-confirm-modal>
      </div>
    @endif
  </div>
@endsection

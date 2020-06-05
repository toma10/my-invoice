@extends('layouts.app')

@section('content')
@if (count($invoices) > 0)
  <x-page-header>
    <x-page-title>My Invoices</x-page-title>
    <div class="flex irems-center space-x-3">
      <x-form :action="route('exportInvoices')">
        <x-button variant="plain">Export</x-button>
      </x-form>
      <x-create-button-link :href="route('invoices.create')">New Invoice</x-create-button-link>
    </div>
  </x-page-header>
  <div class="mt-12">
    @include('invoices.partials._list')
  </div>
@else
  @include('invoices.partials._empty')
@endif
@endsection

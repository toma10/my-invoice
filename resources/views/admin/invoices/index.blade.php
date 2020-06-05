@extends('layouts.admin')

@section('content')
<x-page-header>
  <x-page-title>Invoices</x-page-title>
  <x-form :action="route('admin.exportInvoices')">
    <x-button variant="plain">Export</x-button>
  </x-form>
</x-page-header>
<div class="mt-12">
  @include('admin.invoices.partials._list')
  {{ $invoices->links('layouts.partials._paginator') }}
</div>
@endsection

@extends('layouts.app')

@section('content')
<header>
  <div class="flex justify-between items-center border-b border-gray-200 pb-6">
    <h2 class="text-3xl font-bold leading-tight text-gray-900">
      Edit Invoice
    </h2>
  </div>
</header>
<div class="mt-12">
  <x-form :action="route('invoices.update', $invoice)" method="PUT" enctype="multipart/form-data">
    @include('invoices._form')
  </x-form>
</div>
@endsection

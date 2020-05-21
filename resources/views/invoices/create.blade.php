@extends('layouts.app')

@section('content')
<header>
  <div class="flex justify-between items-center border-b border-gray-200 pb-6">
    <h2 class="text-3xl font-bold leading-tight text-gray-900">
      New Invoice
    </h2>
  </div>
</header>
<div class="mt-12">
  <x-form :action="route('invoices.store')" enctype="multipart/form-data">
    @include('invoices.partials._form')
  </x-form>
</div>
@endsection

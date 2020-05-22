@extends('layouts.app')

@section('content')
<x-page-header>
  <x-page-title>New Invoice</x-page-title>
</x-page-header>
<div class="mt-12">
  <x-form :action="route('invoices.store')" enctype="multipart/form-data">
    @include('invoices.partials._form')
  </x-form>
</div>
@endsection

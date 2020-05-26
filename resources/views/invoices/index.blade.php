@extends('layouts.app')

@section('content')
@if(count($invoices) > 0)
  <x-page-header>
    <x-page-title>My Invoices</x-page-title>
    <x-create-button-link :href="route('invoices.create')">New Invoice</x-create-button-link>
  </x-page-header>
  <div class="mt-12">
    @include('invoices.partials._list')
    {{ $invoices->links('layouts.partials._paginator') }}
  </div>
@else
  @include('invoices.partials._empty')
@endif
@endsection

@extends('layouts.app')

@section('content')
@if(count($invoices) > 0)
  <header>
    <div class="flex justify-between items-center border-b border-gray-200 pb-6">
      <h2 class="text-3xl font-bold leading-tight text-gray-900">
        My Invoices
      </h2>
      <a href="{{ route('invoices.create') }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-indigo-500 border border-transparent rounded-md hover:bg-indigo-400 focus:outline-none focus:shadow-outline-indigo focus:border-indigo-600 active:bg-indigo-600">
        <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
        </svg>
        <span>New Invoice</span>
      </a>
    </div>
  </header>
  <div class="mt-12">
    @include('invoices._list')
  </div>

@else
  @include('invoices._empty')
@endif
@endsection

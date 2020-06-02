@extends('layouts.app')

@section('content')
<x-page-header>
  <div class="flex items-center space-x-3">
    <x-page-title>Invoice {{ $invoice->variable_symbol }}</x-page-title>
    <x-invoice-status :status="$invoice->status" size="md" />
  </div>
  @if (! $invoice->isClosed())
    <x-edit-button-link :href="route('invoices.edit', $invoice)">Edit</x-edit-button-link>
  @endif
</x-page-header>

<div class="mt-12">
  @include('invoices.partials._basicInformation')

  <div class="hidden sm:block">
    <div class="py-5">
      <div class="border-t border-gray-200"></div>
    </div>
  </div>

  <div class="mt-10 sm:mt-0 bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">
        Invoice items
      </h3>
      <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
        What are you invoicing for?
      </p>
    </div>
    <div class="px-4 py-5 sm:px-6">
      <dl class="grid grid-cols-1 col-gap-4 row-gap-8 sm:grid-cols-2">
        <div class="sm:col-span-1">
          <p class="text-gray-300">Not Yet</p>
        </div>
      </dl>
    </div>
  </div>

  <div class="hidden sm:block">
    <div class="py-5">
      <div class="border-t border-gray-200"></div>
    </div>
  </div>

  <div class="mt-10 sm:mt-0 bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">
        Additional information
      </h3>
      <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
        Only you will see this.
      </p>
    </div>
    <div class="px-4 py-5 sm:px-6">
      <dl class="grid grid-cols-1 col-gap-4 row-gap-8 sm:grid-cols-2">
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Note
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            {{ $invoice->note ?: '-' }}
          </dd>
        </div>
      </dl>
    </div>
  </div>

  <div class="hidden sm:block">
    <div class="py-5">
      <div class="border-t border-gray-200"></div>
    </div>
  </div>

  <div class="mt-10">
    @include('invoices.partials._activityLog')
  </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<x-page-header>
  <div class="flex items-center space-x-3">
    <x-page-title>Invoice {{ $invoice->company_registration_number }}</x-page-title>
    <x-tag variant="blue" size="md">Created</x-tag>
  </div>
  <x-edit-button-link :href="route('invoices.edit', $invoice)">Edit</x-edit-button-link>
</x-page-header>

<div class="mt-12">
  <div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">
        Information
      </h3>
      <p class="mt-1 max-w-2xl text-sm leading-5 text-gray-500">
        Basic invoice information.
      </p>
    </div>
    <div class="px-4 py-5 sm:px-6">
      <dl class="grid grid-cols-1 col-gap-4 row-gap-8 sm:grid-cols-2">
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Department
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            {{ $invoice->department->name }}
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Company Registration Number
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            {{ $invoice->company_registration_number }}
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Period
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            {{ $invoice->period->format('M, Y') }}
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Invoice Date
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            {{ $invoice->invoice_date->toFormattedDateString() }}
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Date of Taxable Supply
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            {{ $invoice->date_of_taxable_supply->toFormattedDateString() }}
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Due Date
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            {{ $invoice->due_date->toFormattedDateString() }}
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Variable Symbol
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            {{ $invoice->variable_symbol }}
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Constant Symbol
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            {{ $invoice->constant_symbol ?: '-' }}
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Hours
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            {{ $invoice->hours }}
          </dd>
        </div>
        <div class="sm:col-span-1"></div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Description
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            {{ $invoice->description }}
          </dd>
        </div>
        <div class="sm:col-span-1"></div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Price
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            {{ number_format($invoice->price, 2) }} {{ $invoice->currency }}
          </dd>
        </div>
        <div class="sm:col-span-1"></div>
        <div class="sm:col-span-2">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            PDF File
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            <ul class="border border-gray-200 rounded-md">
              <li class="pl-3 pr-4 py-3 flex items-center justify-between text-sm leading-5">
                <div class="w-0 flex-1 flex items-center">
                  <svg class="flex-shrink-0 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"/>
                  </svg>
                  <span class="ml-2 flex-1 w-0 truncate">
                    {{ $invoice->pdf_file_filename }}
                  </span>
                </div>
                <div class="ml-4 flex-shrink-0">
                  <x-form :action="route('invoices.download', $invoice)">
                    <x-button as-link>Download</x-button>
                  </x-form>
                </div>
              </li>
            </ul>
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
</div>
@endsection

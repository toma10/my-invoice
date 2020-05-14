@extends('layouts.app')

@section('content')
<header>
  <div class="flex justify-between items-center border-b border-gray-200 pb-6">
    <div class="flex items-center space-x-3">
      <h2 class="text-3xl font-bold leading-tight text-gray-900">
        Invoice 20200005
      </h2>
      <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium leading-5 bg-blue-100 text-blue-800">
        Created
      </span>
    </div>
    <a href="{{ route('invoices.edit', 1) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-indigo-500 border border-transparent rounded-md hover:bg-indigo-400 focus:outline-none focus:shadow-outline-indigo focus:border-indigo-600 active:bg-indigo-600">
      <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20">
        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
      </svg>
      <span>Edit</span>
    </a>
  </div>
</header>
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
            Department A
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Company Registration Number
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            XXXXXXXXX
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Period
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            Apr 2020
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Invoice Date
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            2020/04/30
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Date of Taxable Supply
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            2020/04/30
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Due Date
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            2020/05/15
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Variable Symbol
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            20200005
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Constant Symbol
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            -
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Hours
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            160
          </dd>
        </div>
        <div class="sm:col-span-1"></div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Description
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nostrum iste, similique hic vero incidunt minus illo cum voluptates ducimus quidem.
          </dd>
        </div>
        <div class="sm:col-span-1"></div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Price
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            35000 KČ
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            VAT
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            160
          </dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Total price with VAT
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900">
            35000 KČ
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
                    20200005.pdf
                  </span>
                </div>
                <div class="ml-4 flex-shrink-0">
                  <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500 transition duration-150 ease-in-out">
                    Download
                  </a>
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
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, officia repellendus dolore impedit perspiciatis magnam aliquam consectetur commodi nemo rem nisi magni atque assumenda, itaque non temporibus. Magnam, quaerat, adipisci.
          </dd>
        </div>
      </dl>
    </div>
  </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="hidden flex flex-col items-center">
  <span>
    <svg class="w-48 lg:w-64 h-auto" viewBox="0 0 427.96506 546.26859"><path fill="#3f3d56" d="M257.738 535.649H0v-2.106h258.12l-.382 2.106z"/><path fill="#a0616a" d="M89.053 505.128l-15 1 2-157h37l-24 156zM161.053 505.128l-15 1 2-157 23.93.006-10.93 155.994z"/><path d="M177.05275 488.1277c-15.70166 7.16095-30.46015 6.79583-44.50812.76083l-7.49188-179.76083-21.45862 178.18731c-15.69074 3.882-31.55036 3.865-47.54138.81269 3.6831-26.69269 19.40612-189.19538 18-219l105-5zM86.37017 546.26858a15.1713 15.1713 0 01-15.1448-16.06765l1.44716-24.4515c5.82716-10.44764 12.9-10.48986 21.14323-.75512l6.97824 21.39945a15.17131 15.17131 0 01-14.42383 19.87482zM157.37017 546.26858a15.1713 15.1713 0 01-15.1448-16.06765l1.44716-24.4515c5.82716-10.44764 12.9-10.48986 21.14323-.75512l6.97824 21.39945a15.17131 15.17131 0 01-14.42383 19.87482z" fill="#2f2e41"/><circle cx="137.05274" cy="41.1277" r="29" fill="#a0616a"/><path d="M136.05275 96.1277l-47-19c11.248-5.51334 18.885-15.75937 25-28h21c-1.00171 18.67778-1.80841 36.91577 1 47z" fill="#a0616a"/><path d="M182.05275 271.1277l-112 3c1.364-53.77922-1.02882-109.1162-6.64346-165.7891a29.127 29.127 0 0118.76745-30.1324l10.876-4.0785 44 12 20.766 15.9206a21.257 21.257 0 018.24412 18.348c-3.14379 45.91137 3.87567 97.01899 15.98989 150.7314z" fill="#6875f5"/><path d="M194.54016 309.00449a11.66222 11.66222 0 01-12.26574-10.35548l-2.4756-22.29213 13.23085-3.68608 10.92467 18.84112a11.66222 11.66222 0 01-9.41418 17.49257z" fill="#a0616a"/><path d="M206.05275 278.1277l-26 1-20-80-5-99a20.76177 20.76177 0 0118.02261 17.99714l8.97738 71.00286z" fill="#6875f5"/><path opacity=".2" d="M82.553 129.628l-1 66 44 74-39-76-4-64zM69.277 229.313l26.079 44.815-9.242-.5-16.837-44.315z"/><path d="M129.68344 220.59206a4.59435 4.59435 0 00-4.589 4.589v284.51608a4.59435 4.59435 0 004.589 4.58895h293.69267a4.59435 4.59435 0 004.58895-4.58895V225.18101a4.59435 4.59435 0 00-4.58895-4.589z" fill="#e6e6e6"/><path d="M136.59426 502.78629h279.87061V232.09197H136.59426z" fill="#fff"/><path d="M161.52141 275.21723c-1.86725 0-3.38649 2.67629-3.38649 5.96563s1.51924 5.96564 3.38649 5.96564h127.64484c1.86725 0 3.3865-2.67629 3.3865-5.96564s-1.51925-5.96563-3.3865-5.96563zM161.52141 311.92881c-1.86725 0-3.38649 2.67629-3.38649 5.96564s1.51924 5.96563 3.38649 5.96563h127.64484c1.86725 0 3.3865-2.67629 3.3865-5.96563s-1.51925-5.96564-3.3865-5.96564zM161.52141 348.21723c-1.86725 0-3.38649 2.67629-3.38649 5.96563s1.51924 5.96564 3.38649 5.96564h127.64484c1.86725 0 3.3865-2.67629 3.3865-5.96564s-1.51925-5.96563-3.3865-5.96563zM161.52141 384.92881c-1.86725 0-3.38649 2.67629-3.38649 5.96564s1.51924 5.96563 3.38649 5.96563h127.64484c1.86725 0 3.3865-2.67629 3.3865-5.96563s-1.51925-5.96564-3.3865-5.96564zM353.83473 275.60984a5.96563 5.96563 0 000 11.93126h23.86253a5.96563 5.96563 0 000-11.93126zM353.83473 311.60984a5.96563 5.96563 0 000 11.93126h23.86253a5.96563 5.96563 0 000-11.93126zM353.83473 347.60984a5.96563 5.96563 0 000 11.93126h23.86253a5.96563 5.96563 0 000-11.93126zM353.83473 383.60984a5.96563 5.96563 0 000 11.93126h23.86253a5.96563 5.96563 0 000-11.93126z" fill="#e6e6e6"/><path d="M346.56303 443.97399a7.6015 7.6015 0 000 15.203h30.40593a7.6015 7.6015 0 000-15.203z" fill="#6875f5"/><path fill="#e6e6e6" d="M158.55274 423.6277h225v2h-225z"/><path d="M132.39814 304.07835a11.66224 11.66224 0 01-15.30254-4.84941l-10.84868-19.63095 10.79986-8.4856 17.32392 13.19918a11.66221 11.66221 0 01-1.97256 19.76678z" fill="#a0616a"/><path d="M125.05275 272.1277l-22 12-50-86-5.762-75.62608a39.49893 39.49893 0 0125.27824-39.8948l6.48375-2.47908 4 114z" fill="#6875f5"/><path d="M161.66014 9.29862l.32239 4.83567-2.48987-6.63965a38.65038 38.65038 0 00-21.484-7.36694l-.00006-.00006a28.48408 28.48408 0 00-30.30207 35.84565l.34619 4.15442 8-11h.00006a28.12412 28.12412 0 0127.075-6.07258 47.71738 47.71738 0 0110.01789 4.36524 55.04778 55.04778 0 0112.9071 10.70734l.69495-4.72559c4.67081-8.78606 1.89033-17.70525-5.08758-24.1035z" fill="#2f2e41"/></svg>
  </span>
  <a href="{{ route('invoices.create') }}" class="mt-12 relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-indigo-500 border border-transparent rounded-md hover:bg-indigo-400 focus:outline-none focus:shadow-outline-indigo focus:border-indigo-600 active:bg-indigo-600">
    <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
    </svg>
    <span>Add My First Invoice</span>
  </a>
</div>

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
  <div class="flex flex-col">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
      <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
        <table class="min-w-full">
          <thead>
            <tr>
              <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Variable symbol
              </th>
              <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                For the period
              </th>
              <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Due Date
              </th>
              <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Total price
              </th>
              <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Status
              </th>
              <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                PDF invoice
              </th>
              <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
            </tr>
          </thead>
          <tbody>
            <tr class="bg-white">
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                <a href="{{ route('invoices.show', 1) }}" class="text-indigo-600 hover:text-indigo-900">20200005</a>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                Apr 2020
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                2020/05/15
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                14 000,00 Kč
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium leading-4 bg-blue-100 text-blue-800">
                  Created
                </span>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 space-x-2">
                <a href="#" class="text-indigo-600 hover:text-indigo-900">Show</a>
                <a href="#" class="text-indigo-600 hover:text-indigo-900">Download</a>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium space-x-2">
                <a href="{{ route('invoices.edit', 1) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                <a href="#" class="text-indigo-600 hover:text-indigo-900">Delete</a>
              </td>
            </tr>
            <tr class="bg-gray-50">
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                <a href="{{ route('invoices.show', 1) }}" class="text-indigo-600 hover:text-indigo-900">20200004</a>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                Mar 2020
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                2020/04/15
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                35 000,00 Kč
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium leading-4 bg-green-100 text-green-800">
                  Approved
                </span>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 space-x-2">
                <a href="#" class="text-indigo-600 hover:text-indigo-900">Show</a>
                <a href="#" class="text-indigo-600 hover:text-indigo-900">Download</a>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium space-x-2">
                <a href="#" class="text-indigo-600 hover:text-indigo-900">Delete</a>
              </td>
            </tr>
            <tr class="bg-white">
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                <a href="{{ route('invoices.show', 1) }}" class="text-indigo-600 hover:text-indigo-900">20200003</a>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                 Feb 2020
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                2020/03/15
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                35 000,00 Kč
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium leading-4 bg-pink-100 text-pink-800">
                  Denied
                </span>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 space-x-2">
                <a href="#" class="text-indigo-600 hover:text-indigo-900">Show</a>
                <a href="#" class="text-indigo-600 hover:text-indigo-900">Download</a>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium space-x-2">
                <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                <a href="#" class="text-indigo-600 hover:text-indigo-900">Delete</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

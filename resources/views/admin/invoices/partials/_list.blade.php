<div class="flex flex-col">
  <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
    <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
      <table class="min-w-full">
        <thead>
          <tr>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
              Id
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
              Department
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
              User
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
              Invoice Date
            </th>
            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
              Period
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
          </tr>
        </thead>
        <tbody>
          @foreach ($invoices as $invoice)
            <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }}">
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                <x-link href="#">
                  {{ $invoice->id }}
                </x-link>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                <x-link href="#">
                  {{ $invoice->department->name }}
                </x-link>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                <x-link href="#">
                  {{ $invoice->user->name }}
                </x-link>
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                {{ $invoice->invoice_date->toFormattedDateString() }}
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                {{ $invoice->period->format('M, Y') }}
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                {{ $invoice->due_date->toFormattedDateString() }}
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                {{ number_format($invoice->price, 2) }} {{ $invoice->currency }}
              </td>
              <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                <x-tag size="sm" variant="blue">Created</x-tag>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

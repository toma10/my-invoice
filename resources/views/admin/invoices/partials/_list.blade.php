<x-table.table>
  <thead>
    <tr>
      <x-table.th>Id</x-table.th>
      <x-table.th>Department</x-table.th>
      <x-table.th>User</x-table.th>
      <x-table.th>Invoice Date</x-table.th>
      <x-table.th>Period</x-table.th>
      <x-table.th>Due Date</x-table.th>
      <x-table.th>Total Price</x-table.th>
      <x-table.th>Status</x-table.th>
    </tr>
  </thead>
  <tbody>
    @foreach ($invoices as $invoice)
      <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }}">
        <x-table.td>
          <x-link href="#">
            {{ $invoice->id }}
          </x-link>
        </x-table.td>
        <x-table.td>
          <x-link href="#">
            {{ $invoice->department->name }}
          </x-link>
        </x-table.td>
        <x-table.td>
          <x-link href="#">
            {{ $invoice->user->name }}
          </x-link>
        </x-table.td>
        <x-table.td>
          {{ $invoice->invoice_date->toFormattedDateString() }}
        </x-table.td>
        <x-table.td>
          {{ $invoice->period->format('M, Y') }}
        </x-table.td>
        <x-table.td>
          {{ $invoice->due_date->toFormattedDateString() }}
        </x-table.td>
        <x-table.td>
          {{ number_format($invoice->price, 2) }} {{ $invoice->currency }}
        </x-table.td>
        <x-table.td>
          <x-tag size="sm" variant="blue">Created</x-tag>
        </x-table.td>
      </tr>
    @endforeach
  </tbody>
</x-table.table>

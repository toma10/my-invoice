<x-table.table>
  <thead>
    <tr>
      <x-table.th>Variable Symbol</x-table.th>
      <x-table.th>Period</x-table.th>
      <x-table.th>Due Date</x-table.th>
      <x-table.th>Total Price</x-table.th>
      <x-table.th>Status</x-table.th>
      <x-table.th>PDF Invoice</x-table.th>
      <x-table.th />
    </tr>
  </thead>
  <tbody>
    @foreach ($invoices as $invoice)
      <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }}">
        <x-table.td>
          <x-link href="{{ route('invoices.show', $invoice) }}">
            {{ $invoice->variable_symbol }}
          </x-link>
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
          <x-invoice-status :status="$invoice->status" size="sm" />
        </x-table.td>
        <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 space-x-2">
          {{-- <x-link href="#">Show</x-link> --}}
          <x-form :action="route('invoices.download', $invoice)">
            <x-button as-link>Download</x-button>
          </x-form>
        </td>
        <x-table.td aligt-right>
          @if ($invoice->hasStatus(\App\Status::CREATED))
            <x-link href="{{ route('invoices.edit', $invoice) }}">Edit</x-link>
            <x-delete-modal
              :action="route('invoices.destroy', $invoice)"
              title="Delete Invoice"
              body="Are you sure you want to delete invoice? This action cannot be undone."
            >
              <x-button type="button" as-link @click="$dispatch('open')">
                Delete
              </x-button>
            </x-delete-modal>
          @endif
        </x-table.td>
      </tr>
    @endforeach
  </tbody>
</x-table.table>
{{ $invoices->links('layouts.partials._paginator') }}

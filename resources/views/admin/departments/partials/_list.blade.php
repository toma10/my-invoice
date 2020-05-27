<x-table.table class="min-w-full">
  <thead>
    <tr>
      <x-table.th>Id</x-table.thth>
      <x-table.th>Name</x-table.th>
      <x-table.th />
    </tr>
  </thead>
  <tbody>
    @foreach ($departments as $department)
      <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }}">
        <x-table.td>
          <x-link href="#">
             {{ $department->id }}
          </x-link>
        </x-table.td>
        <x-table.td>{{ $department->name }}</x-table.td>
        <x-table.td aligt-right>
          <x-link :href="route('admin.departments.edit', $department)">Edit</x-link>
        </x-table.td>
      </tr>
    @endforeach
  </tbody>
</x-table.table>

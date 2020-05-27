<x-table.table>
  <thead>
    <tr>
      <x-table.th>Id</x-table.th>
      <x-table.th>Name</x-table.th>
      <x-table.th>Email</x-table.th>
      <x-table.th>Role</x-table.th>
      <x-table.th>State</x-table.th>
    </tr>
  </thead>
  <tbody>
    @foreach ($users as $user)
      <tr class="{{ $loop->odd ? 'bg-white' : 'bg-gray-50' }}">
        <x-table.td>
          <x-link href="#">
            {{ $user->id }}
          </x-link>
        </x-table.td>
        <x-table.td>{{ $user->name ?? '-' }}</x-table.td>
        <x-table.td>{{ $user->email }}</x-table.td>
        <x-table.td>
          @if ($user->isAdmin())
            <x-tag size="sm" variant="yellow">Admin</x-tag>
          @else
            <x-tag size="sm" variant="gray">User</x-tag>
          @endif
        </x-table.td>
        <x-table.td>
          <x-tag size="sm" variant="green">Active</x-tag>
        </x-table.td>
      </tr>
    @endforeach
  </tbody>
</x-table.table>
{{ $users->links('layouts.partials._paginator') }}

@props(['user', 'size'])

@if ($user->isActive())
  <x-tag :size="$size" variant="green">Active</x-tag>
@else
  <x-tag size="sm" variant="red">Inactive</x-tag>
@endif

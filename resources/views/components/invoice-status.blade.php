@props(['status', 'size'])

<x-tag :size="$size" :variant="$status->color">
  {{ $status->label }}
</x-tag>

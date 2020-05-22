@props(['variant', 'size'])

@php
  $variants = [
    'blue' => 'bg-blue-100 text-blue-800',
    'green' => 'bg-green-100 text-green-800',
    'red' => 'bg-pink-100 text-pink-800',
    'yellow' => 'bg-yellow-100 text-yellow-800',
    'gray' => 'bg-gray-100 text-gray-800',
  ];

  $sizes = [
    'sm' => 'px-2 py-0.5 rounded text-xs font-medium leading-4',
    'md' => 'px-2.5 py-0.5 rounded-md text-sm font-medium leading-5',
  ];
@endphp

<span class="inline-flex items-center {{ $sizes[$size] }} {{ $variants[$variant] }}">
  {{ $slot }}
</span>

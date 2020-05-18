@props([
  'type' => 'submit',
  'variant' => 'primary',
  'fullWidth' => false,
])

@php
  $variants = [
    'primary' => 'bg-indigo-600 text-white border-transparent hover:bg-indigo-500 focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700',
    'plain' => 'bg-white text-gray-700 border-gray-300 hover:text-gray-500 focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800',
  ]
@endphp

<span class="inline-flex {{ $fullWidth ? 'w-full' : '' }} rounded-md shadow-sm">
  <button
    type="{{ $type }}"
    class="{{ $variants[$variant] }} inline-flex justify-center w-full px-4 py-2 text-sm font-medium transition duration-150 ease-in-out border rounded-md focus:outline-none"
  >
    {{ $slot }}
  </button>
</span>

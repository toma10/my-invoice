@props([
  'type' => 'submit',
  'asLink' => false,
  'variant' => 'primary',
  'fullWidth' => false,
])

@php
  $variants = [
    'primary' => 'bg-indigo-600 text-white border-transparent hover:bg-indigo-500 focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700',
    'plain' => 'bg-white text-gray-700 border-gray-300 hover:text-gray-500 focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800',
    'danger' => 'bg-red-600 text-white border-transparent hover:bg-red-500 focus:border-red-700 focus:shadow-outline-red active:bg-red-700',
  ];

  $classes = [
    'link' => 'text-sm font-medium leading-5 text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500 focus:outline-none focus:underline',
    'button' => sprintf(
      '%s inline-flex justify-center px-4 py-2 w-full text-sm font-medium transition duration-150 ease-in-out rounded-md border focus:outline-none %s',
      $fullWidth ? 'w-full' : '',
      $variants[$variant]
    ),
  ];
@endphp

<span class="inline-flex {{ $fullWidth ? 'w-full' : '' }} rounded-md shadow-sm">
  <button
    type="{{ $type }}"
    class="{{ $asLink ? $classes['link']  : $classes['button'] }}"
    {{ $attributes }}
  >
    {{ $slot }}
  </button>
</span>

@props(['href'])

<a
  href="{{ $href }}"
  class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-indigo-500 border border-transparent rounded-md hover:bg-indigo-400 focus:outline-none focus:shadow-outline-indigo focus:border-indigo-600 active:bg-indigo-600"
>
  <span class="w-5 h-5 mr-2 -ml-1">
    {{ $icon }}
  </span>
  <span>{{ $slot }}</span>
</a>

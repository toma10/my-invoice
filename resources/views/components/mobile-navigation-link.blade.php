<a
  href="{{ $href }}"
  class="block px-3 py-2 rounded-md {{ $isActive() ? 'bg-gray-900 text-white' : 'text-gray-300 hover:text-white hover:bg-gray-700' }} text-base font-medium focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
  {{ $attributes }}
>
  {{ $slot }}
</a>

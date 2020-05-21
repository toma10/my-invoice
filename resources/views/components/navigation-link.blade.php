<a
  href="{{ $href }}"
  class="px-3 py-2 text-sm font-medium leading-5 rounded-md {{ $isActive() ? 'text-white bg-gray-900' : 'text-gray-300 hover:text-white hover:bg-gray-700' }} focus:outline-none focus:text-white focus:bg-gray-700 transition duration-150 ease-in-out"
>
  {{ $slot }}
</a>

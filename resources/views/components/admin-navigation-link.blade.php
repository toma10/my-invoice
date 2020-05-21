<a
  href="{{ $href }}"
  class="group flex justify-center lg:justify-start items-center px-3 py-2 text-sm {{ $isActive() ? 'text-gray-900 bg-gray-200 hover:text-gray-900 focus:bg-gray-300' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50 focus:text-gray-900 focus:bg-gray-200' }} leading-5 font-medium rounded-md focus:outline-none transition ease-in-out duration-150"
>
  <span
    class="flex-shrink-0 -ml-1 mr-3 h-6 w-6 {{ $isActive() ? 'text-gray-500 group-hover:text-gray-500 group-focus:text-gray-600' : 'text-gray-400 group-focus:text-gray-500' }} transition ease-in-out duration-150"
  >
    {{ $icon }}
  </span>
  <span class="truncate">
    {{ $slot }}
  </span>
</a>

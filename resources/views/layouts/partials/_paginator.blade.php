@if ($paginator->hasPages())
  <nav class="mt-8 border-t border-gray-200 px-4 flex items-center justify-between sm:px-0">
    <div class="w-0 flex-1 flex">
      @if ($paginator->onFirstPage())
        <span
          aria-disabled="true"
          class="-mt-px border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm leading-5 font-medium text-gray-500 cursor-not-allowed"
        >
          <x-heroicon-s-arrow-narrow-left class="mr-3 h-5 w-5 text-gray-400" />
          {{ __('pagination.previous') }}
        </span>
      @else
        <a href="{{ $paginator->previousPageUrl() }}"
          rel="prev"
          class="-mt-px border-t-2 border-transparent pt-4 pr-1 inline-flex items-center text-sm leading-5 font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-400 transition ease-in-out duration-150"
        >
          <x-heroicon-s-arrow-narrow-left class="mr-3 h-5 w-5 text-gray-400" />
          {{ __('pagination.previous') }}
        </a>
      @endif
    </div>
    <div class="hidden md:flex">
      @foreach ($elements as $element)
          @if (is_string($element))
            <span class="-mt-px border-t-2 border-transparent pt-4 px-4 inline-flex items-center text-sm leading-5 font-medium text-gray-500">
              ...
            </span>
          @endif

          @if (is_array($element))
              @foreach ($element as $page => $url)
                  @if ($page == $paginator->currentPage())
                    <a href="{{ $url }}"
                      aria-current="page"
                      class="-mt-px border-t-2 border-indigo-500 pt-4 px-4 inline-flex items-center text-sm leading-5 font-medium text-indigo-600 focus:outline-none focus:text-indigo-800 focus:border-indigo-700 transition ease-in-out duration-150"
                    >
                      {{ $page }}
                    </a>
                  @else
                    <a href="{{ $url }}"
                      class="-mt-px border-t-2 border-transparent pt-4 px-4 inline-flex items-center text-sm leading-5 font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-400 transition ease-in-out duration-150"
                    >
                      {{ $page }}
                    </a>
                  @endif
              @endforeach
          @endif
      @endforeach
    </div>
    <div class="w-0 flex-1 flex justify-end">
      @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"
          rel="next"
          class="-mt-px border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm leading-5 font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-400 transition ease-in-out duration-150"
        >
          {{ __('pagination.next') }}
          <x-heroicon-s-arrow-narrow-right class="ml-3 h-5 w-5 text-gray-400" />
        </a>
      @else
        <span
          aria-disabled="true"cursor-not-allowed
          class="-mt-px border-t-2 border-transparent pt-4 pl-1 inline-flex items-center text-sm leading-5 font-medium text-gray-500 cursor-not-allowed"
        >
          {{ __('pagination.next') }}
          <x-heroicon-s-arrow-narrow-right class="ml-3 h-5 w-5 text-gray-400" />
        </span>
      @endif
    </div>
  </nav>
@endif

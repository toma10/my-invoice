@props(['title', 'subtitle'])

<div class="md:grid md:grid-cols-3 md:gap-6">
  <div class="md:col-span-1">
    <div class="px-4 sm:px-0">
      <h3 class="text-lg font-medium leading-6 text-gray-900">{{ $title }}</h3>
      <p class="mt-1 text-sm leading-5 text-gray-600">
        {{ $subtitle }}
      </p>
    </div>
  </div>
  <div class="mt-5 md:mt-0 md:col-span-2">
    <div class="border border-gray-100 shadow overflow-hidden sm:rounded-md">
      <div class="px-4 py-5 bg-white sm:p-6">
        <div class="grid grid-cols-6 gap-6">
          {{ $slot }}
        </div>
      </div>
      @isset($footer)
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
          {{ $footer }}
        </div>
      @endisset
    </div>
  </div>
</div>

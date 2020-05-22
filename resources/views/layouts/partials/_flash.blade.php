@if (flash()->message)
  <div class="mb-10 px-4 py-3 bg-{{ flash()->class }}-50 border-l-4 border-{{ flash()->class }}-400">
    <div class="flex">
      <div class="flex-shrink-0">
        <span class="h-5 w-5 text-{{ flash()->class }}-400">
          @switch(flash()->level)
            @case('success')
              <x-heroicon-s-check-circle class="h-5 w-5 text-{{ flash()->class }}-400" />
              @break
            @case('info')
              <x-heroicon-s-information-circle class="h-5 w-5 text-{{ flash()->class }}-400" />
              @break
            @case('warning')
              <x-heroicon-s-exclamation class="h-5 w-5 text-{{ flash()->class }}-400" />
              @break
            @case('error')
              <x-heroicon-s-x-circle class="h-5 w-5 text-{{ flash()->class }}-400" />
              @break
          @endswitch
        </span>
      </div>
      <div class="ml-3 flex-1 text-{{ flash()->class }}-700">
        <p class="text-sm leading-5">
          {{ flash()->message }}
        </p>
      </div>
    </div>
  </div>
@endif

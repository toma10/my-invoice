@if (flash()->message)
  <div class="mb-10 px-4 py-3 bg-{{ flash()->class }}-50 border-l-4 border-{{ flash()->class }}-400">
    <div class="flex">
      <div class="flex-shrink-0">
        <svg class="h-5 w-5 text-{{ flash()->class }}-400" fill="currentColor" viewBox="0 0 20 20">
        @switch(flash()->level)
          @case('success')
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
            />
            @break
          @case('info')
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
            />
            @break
          @case('warning')
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
            />
            @break
          @case('error')
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
            />
            @break
        @endswitch
        </svg>
      </div>
      <div class="ml-3 flex-1 text-{{ flash()->class }}-700">
        <p class="text-sm leading-5">
          {{ flash()->message }}
        </p>
      </div>
    </div>
  </div>
@endif

@props(['title', 'body', 'type' => 'success'])

<div
  class="inline-block"
  x-data="{ show: false }"
  @open="show = true"
  @close="show = false"
  x-init="
    $watch('show', show => {
      if (show) {
        $nextTick(() => {
          if ($refs.primaryButton) {
            $refs.primaryButton.focus()
          }
        })
      }
    })
  "
>
  {{ $slot }}
  <template x-if="show">
    <div
      class="transition fixed bottom-0 inset-x-0 px-4 pb-4 sm:inset-0 sm:flex sm:items-center sm:justify-center"
      x-transition:enter="ease-out duration-300"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="ease-in duration-200"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      @keydown.escape.window="show = false"
    >
      <div class="fixed inset-0 transition-opacity">
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
      </div>

      <div
        class="bg-white rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:p-6"
        role="dialog"
        aria-modal="true"
        aria-labelledby="modal-headline"
        x-show="show"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        @click.away="show = false"
      >
        <div class="sm:flex sm:items-start">
          <div class="flex-shrink-0">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-{{ $type === 'warning' ? 'red' : 'green' }}-100 sm:mx-0 sm:h-10 sm:w-10">
              @if ($type === 'warning')
                <x-heroicon-o-exclamation class="h-6 w-6 text-red-600" />
              @else
                <x-heroicon-o-check class="h-6 w-6 text-green-600" />
              @endif
            </div>
          </div>
          <div class="mt-3 text-center sm:flex-1 sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
              {{ $title }}
            </h3>
            <div class="mt-2">
              <p class="text-sm leading-5 text-gray-500 whitespace-normal">
                {{ $body }}
              </p>
            </div>
          </div>
        </div>
        <div class="mt-5 space-y-3 sm:space-y-0 sm:mt-4 sm:space-x-3 sm:space-x-reverse sm:flex sm:flex-row-reverse">
          {{ $buttons }}
        </div>
      </div>
    </div>
  </template>
</div>

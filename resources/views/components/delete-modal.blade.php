@props(['action', 'title', 'body'])

<x-modal
  :action="$action"
  :title="$title"
  :body="$body"
  type="warning"
>
  <x-slot name="buttons">
    <span class="flex w-full rounded-md shadow-sm sm:w-auto">
      <button
        type="button"
        class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5"
        @click="$refs.form.submit()"
        x-ref="primaryButton"
      >
        Delete
      </button>
    </span>
    <span class="flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
      <button
        type="button"
        class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5"
        @click="$dispatch('close')"
      >
        Cancel
      </button>
    </span>
  </x-slot>

  <x-form :action="$action" method="DELETE" x-ref="form">
    {{ $slot }}
  </x-form>
</x-modal>

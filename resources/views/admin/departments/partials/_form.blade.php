<x-form-panel
  title="Information"
  subtitle="Basic department information."
>
  <div class="col-span-6 lg:col-span-3">
    <x-text-field
      name="name"
      label="Name"
      :value="$department->name"
      required
      autofocus
    />
  </div>
</x-form-panel>

<div class="mt-8 border-t border-gray-200 pt-5">
  <div class="flex justify-end space-x-3">
    <x-link href="{{ url()->previous() }}" as-button variant="plain">Cancel</x-link>
    <x-button>Save</x-button>
  </div>
</div>

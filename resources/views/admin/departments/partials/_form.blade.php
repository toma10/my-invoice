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

<x-form-buttons />

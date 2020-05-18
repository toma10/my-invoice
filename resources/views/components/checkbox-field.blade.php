@props(['name', 'label'])

<div class="flex items-center">
  <input
    id="{{ $name }}"
    name="{{ $name }}"
    type="checkbox"
    class="w-4 h-4 text-indigo-600 transition duration-150 ease-in-out form-checkbox"
  />
  <label for="{{ $name }}" class="block ml-2 text-sm leading-5 text-gray-900">
    {{ $label }}
  </label>
</div>

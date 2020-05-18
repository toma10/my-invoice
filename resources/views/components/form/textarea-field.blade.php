@props([
  'name',
  'label',
  'value',
])

<div>
  <label for="{{ $name }}" class="block text-sm font-medium leading-5 text-gray-700">
    {{ $label }}
  </label>
  <div class="mt-1 rounded-md shadow-sm">
    <textarea
      id="{{ $name }}"
      name="{{ $name }}"
      rows="3"
      class="form-textarea block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
    >{{ old($name, $value ?? '') }}</textarea>
  </div>
  @error($name)
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
  @enderror
</div>

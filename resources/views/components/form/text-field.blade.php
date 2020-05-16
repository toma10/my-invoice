@props([
  'type' => 'text',
  'name',
  'label',
  'value',
  'placeholder',
  'autocomplete',
  'required' => false,
  'autofocus' => false,
])

<div>
  <label for="{{ $name }}" class="block text-sm font-medium leading-5 text-gray-700">
    {{ $label }}
  </label>
  <div class="mt-1 rounded-md shadow-sm">
    <input
      id="{{ $name }}"
      name="{{ $name }}"
      type="{{ $type }}"
      class="block form-input w-full placeholder-gray-400 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
      value="{{ old($name, $value ?? '') }}"
      placeholder="{{ $placeholder ?? '' }}"
      autocomplete="{{ $autocomplete ?? '' }}"
      {{ $required ? 'required' : '' }}
      {{ $autofocus ? 'autofocus' : '' }}
    />
  </div>
  @error($name)
    <p class="mt-1 text-sm text-red-600"> {{ $message }}</p>
  @enderror
</div>

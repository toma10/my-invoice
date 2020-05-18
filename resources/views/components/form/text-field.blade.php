@props([
  'type' => 'text',
  'name',
  'label',
  'value',
  'icon' => null,
])

<div>
  <label for="{{ $name }}" class="block text-sm font-medium leading-5 text-gray-700">
    {{ $label }}
  </label>
  <div class="mt-1 relative rounded-md shadow-sm">
    @if ($icon)
      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <span class="h-5 w-5 text-gray-400">
          {{ $icon }}
        </span>
      </div>
    @endif
    <input
      id="{{ $name }}"
      name="{{ $name }}"
      type="{{ $type }}"
      class="block w-full{{ $icon ? ' pl-10 ': ' ' }}placeholder-gray-400 transition duration-150 ease-in-out form-input sm:text-sm sm:leading-5"
      value="{{ old($name, $value ?? '') }}"
      {{ $attributes }}
    />
  </div>
  @error($name)
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
  @enderror
</div>

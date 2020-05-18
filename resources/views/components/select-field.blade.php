@props([
  'name',
  'label',
  'options' => [],
  'value' => null,
])

<label for="department" class="block text-sm font-medium leading-5 text-gray-700">
  {{ $label }}
</label>
<select
  id="{{ $name }}"
  name="{{ $name }}"
  class="mt-1 block form-select w-full py-2 px-3 py-0 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
  {{ $attributes }}
>
  @foreach($options as $key => $label)
    <option
      value="{{ $key }}"
      {{ old($name, $value ?? '') == $key ? 'selected' : ''}}
    >
      {{ $label }}
    </option>
  @endforeach
</select>

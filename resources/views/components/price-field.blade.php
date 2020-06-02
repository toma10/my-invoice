<div>
  <label for="price" class="block text-sm leading-5 font-medium text-gray-700">
    Price
  </label>
  <div class="mt-1 relative rounded-md shadow-sm">
    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
      <span class="text-gray-500 sm:text-sm sm:leading-5">
        $
      </span>
    </div>
    <input
      id="price"
      name="price"
      type="number"
      step="0.01"
      class="pl-7 pr-16 form-input block w-full py-2 px-3 border border-gray-300 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5"
      {{ $attributes }}
      value="{{ old('price', $price ?? '') }}"
      placeholder="0.00"
    />
    <div class="absolute inset-y-0 right-0 flex items-center">
      <select aria-label="Currency" name="currency" class="form-select h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm sm:leading-5" required>
        @foreach ($currencies as $currencyCode => $currnecyValue)
          <option
            value="{{ $currencyCode }}"
            {{ old('currency', $currency ?? '') == $currencyCode ? 'selected' : ''}}
          >
          {{ $currnecyValue }}
        </option>
        @endforeach
      </select>
    </div>
  </div>
  @error('price')
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
  @enderror
  @error('currency')
    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
  @enderror
</div>

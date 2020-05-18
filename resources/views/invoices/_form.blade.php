<div>
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Information</h3>
        <p class="mt-1 text-sm leading-5 text-gray-600">
          Basic invoice information.
        </p>
      </div>
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
      <div class="shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
          <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 lg:col-span-3">
              <x-select-field
                name="department_id"
                label="Department"
                :options="$departments"
                :value="$invoice->department_id"
                required
                autofocus
              />
            </div>

            <div class="hidden lg:block lg:col-span-3"></div>

            <div class="col-span-6 lg:col-span-3">
              <x-text-field
                name="company_registration_number"
                label="Company Registration Number"
                :value="$invoice->company_registration_number"
                required
              />
            </div>

            <div class="hidden lg:block lg:col-span-3"></div>

            <div class="col-span-6 lg:col-span-3">
              <x-text-field
                name="period"
                type="month"
                :value="optional($invoice->period)->format('Y-m')"
                label="Period"
              >
                <x-slot name="icon">
                  <x-heroicon-s-calendar />
                </x-slot>
              </x-text-field>
            </div>

            <div class="col-span-6 lg:col-span-3">
              <x-text-field
                name="invoice_date"
                type="date"
                label="Invoice Date"
                :value="optional($invoice->invoice_date)->toDateString()"
                required
              >
                <x-slot name="icon">
                  <x-heroicon-s-calendar />
                </x-slot>
              </x-text-field>
            </div>

            <div class="col-span-6 lg:col-span-3">
              <x-text-field
                name="date_of_taxable_supply"
                type="date"
                label="Date of Taxable Supply"
                :value="optional($invoice->date_of_taxable_supply)->toDateString()"
                required
              >
                <x-slot name="icon">
                  <x-heroicon-s-calendar />
                </x-slot>
              </x-text-field>
            </div>

            <div class="col-span-6 lg:col-span-3">
              <x-text-field
                name="due_date"
                type="date"
                label="Due Date"
                :value="optional($invoice->due_date)->toDateString()"
                required
              >
                ho
              </x-text-field>
            </div>

            <div class="col-span-6 lg:col-span-3">
              <x-text-field
                name="variable_symbol"
                label="Variable Symbol"
                :value="$invoice->variable_symbol"
                required />
            </div>

            <div class="col-span-6 lg:col-span-3">
              <x-text-field
                name="constant_symbol"
                label="Constant Symbol"
                :value="$invoice->constant_symbol"
                />
            </div>

            <div class="col-span-4 md:col-span-4 lg:col-span-3">
              <x-price-field
                name="price"
                label="Price"
                :price="$invoice->price"
                :currency="$invoice->currency"
                required
              />
            </div>

            <div class="hidden lg:block lg:col-span-3"></div>

            <div class="col-span-2 xl:col-span-1">
              <x-text-field
                name="hours"
                type="number"
                label="Hours"
                placeholder="160"
                :value="$invoice->hours"
                required
              >
                <x-slot name="icon">
                  <x-heroicon-s-clock />
                </x-slot>
              </x-text-field>
            </div>

            <div class="hidden lg:block lg:col-span-4 xl:col-span-5"></div>

           <div class="col-span-6">
              <x-text-field
                name="description"
                label="Description"
                :value="$invoice->description"
                required
              />
           </div>

            <div class="col-span-6 lg:col-span-3">
              @if ($invoice->pdf_file_path)
                <x-text-field
                  name="pdf_file"
                  type="file"
                  label="PDF File"
                  accept="application/pdf"
                />
              @else
                <x-text-field
                  name="pdf_file"
                  type="file"
                  label="PDF File"
                  accept="application/pdf"
                  required
                />
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="hidden sm:block">
  <div class="py-5">
    <div class="border-t border-gray-200"></div>
  </div>
</div>

<div class="mt-10 sm:mt-0">
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Invoice items</h3>
        <p class="mt-1 text-sm leading-5 text-gray-600">
          What are you invoicing for?
        </p>
      </div>
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
      <div class="shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
          <div class="grid grid-cols-6 gap-6">
            <p class="text-gray-300">Not Yet</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="hidden sm:block">
  <div class="py-5">
    <div class="border-t border-gray-200"></div>
  </div>
</div>

<div class="mt-10 sm:mt-0">
  <div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
      <div class="px-4 sm:px-0">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Additional information</h3>
        <p class="mt-1 text-sm leading-5 text-gray-600">
          Only you will see this.
        </p>
      </div>
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
      <div class="shadow overflow-hidden sm:rounded-md">
        <div class="px-4 py-5 bg-white sm:p-6">
          <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6">
              <x-textarea-field
                name="note"
                label="Note"
                :value="$invoice->note"
               />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="mt-8 border-t border-gray-200 pt-5">
  <div class="flex justify-end space-x-3">
    <x-link href="{{ url()->previous() }}" as-button variant="plain">Cancel</x-link>
    <x-button>Save</x-button>
  </div>
</div>

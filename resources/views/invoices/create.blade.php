@extends('layouts.app')

@section('content')
<header>
  <div class="flex justify-between items-center border-b border-gray-200 pb-6">
    <h2 class="text-3xl font-bold leading-tight text-gray-900">
      New Invoice
    </h2>
  </div>
</header>
<div class="mt-12">
  <form action="#" method="POST">
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
                  <label for="department" class="block text-sm font-medium leading-5 text-gray-700">
                    Department
                  </label>
                  <select id="department" name="department" class="mt-1 block form-select w-full py-2 px-3 py-0 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" required autofocus>
                    <option>Department A</option>
                    <option>Department B</option>
                    <option>Department C</option>
                  </select>
                </div>

                <div class="hidden lg:block lg:col-span-3"></div>

                <div class="col-span-6 lg:col-span-3">
                  <label for="crn" class="block text-sm font-medium leading-5 text-gray-700">
                    Company Registration Number
                  </label>
                  <input id="crn" name="crn" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" required />
                </div>

                <div class="hidden lg:block lg:col-span-3"></div>

                <div class="col-span-6 lg:col-span-3">
                  <label for="perion" class="block text-sm font-medium leading-5 text-gray-700">
                    Period
                  </label>
                  <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" fill-rule="evenodd"/>
                      </svg>
                    </div>
                    <input id="perion" name="perion" type="month" class="form-input pl-10 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" required />
                  </div>
                </div>

                <div class="col-span-6 lg:col-span-3">
                  <label for="invoice_date" class="block text-sm font-medium leading-5 text-gray-700">
                    Invoice Date
                  </label>
                  <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" fill-rule="evenodd"/>
                      </svg>
                    </div>
                    <input id="invoice_date" name="invoice_date" type="date" class="form-input pl-10 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" required />
                  </div>
                </div>

                <div class="col-span-6 lg:col-span-3">
                  <label for="date_of_taxable_supply" class="block text-sm font-medium leading-5 text-gray-700">
                    Date of Taxable Supply
                  </label>
                  <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" fill-rule="evenodd"/>
                      </svg>
                    </div>
                    <input id="date_of_taxable_supply" name="date_of_taxable_supply" type="date" class="form-input pl-10 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" required />
                  </div>
                </div>

                <div class="col-span-6 lg:col-span-3">
                  <label for="due_date" class="block text-sm font-medium leading-5 text-gray-700">
                    Due Date
                  </label>
                  <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" fill-rule="evenodd"/>
                      </svg>
                    </div>
                    <input id="due_date" name="due_date" type="date" class="form-input pl-10 block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" required />
                  </div>
                </div>

                <div class="col-span-6 lg:col-span-3">
                  <label for="variable_symbol" class="block text-sm font-medium leading-5 text-gray-700">
                    Variable Symbol
                  </label>
                  <input id="variable_symbol" name="variable_symbol" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" required />
                </div>

                <div class="col-span-6 lg:col-span-3">
                  <label for="constant_symbol" class="block text-sm font-medium leading-5 text-gray-700">
                    Constant Symbol
                  </label>
                  <input id="constant_symbol" name="constant_symbol" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                </div>

                <div class="col-span-4 md:col-span-4 lg:col-span-3">
                  <label for="price" class="block text-sm leading-5 font-medium text-gray-700">Price</label>
                  <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <span class="text-gray-500 sm:text-sm sm:leading-5">
                        $
                      </span>
                    </div>
                    <input id="price" name="price" type="number" class="pl-7 pr-16 form-input block w-full py-2 px-3 border border-gray-300 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" placeholder="0.00" required />
                    <div class="absolute inset-y-0 right-0 flex items-center">
                      <select aria-label="Currency" name="currency" class="form-select h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-gray-500 sm:text-sm sm:leading-5" required>
                        <option>CZK</option>
                        <option>USD</option>
                        <option>EUR</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="hidden lg:block lg:col-span-3"></div>

                <div class="col-span-2 xl:col-span-1">
                  <label for="hours" class="block text-sm font-medium leading-5 text-gray-700">
                    Hours
                  </label>
                  <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <svg  class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
                    </div>
                    <input id="hours" name="hours" type="number" class="pl-10 form-input block w-full py-2 px-3 border border-gray-300 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" placeholder="160" required />
                  </div>
                </div>

                <div class="hidden lg:block lg:col-span-4 xl:col-span-5"></div>
{{--
                <div class="col-span-3 lg:col-span-1">
                  <label for="currency" class="block text-sm font-medium leading-5 text-gray-700">
                    Currency
                  </label>
                  <select id="currency" name="currency" class="mt-1 block form-select w-full py-2 px-3 py-0 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5">
                    <option>CZK</option>
                    <option>USD</option>
                    <option>EUR</option>
                  </select>
                </div>

                <div class="hidden lg:block lg:col-span-5"></div>
 --}}

               <div class="col-span-6">
                 <label for="description" class="block text-sm font-medium leading-5 text-gray-700">
                   Description
                 </label>
                 <input id="description" name="description" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
               </div>

                <div class="col-span-6 lg:col-span-3">
                  <label for="file" class="block text-sm font-medium leading-5 text-gray-700">
                    PDF File
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <input id="file" type="file" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5" accept="application/pdf" required />
                  </div>
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
                  <label for="note" class="block text-sm font-medium leading-5 text-gray-700">
                    Note
                  </label>
                  <div class="mt-1 rounded-md shadow-sm">
                    <textarea id="note" rows="3" class="form-textarea block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"></textarea>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mt-8 border-t border-gray-200 pt-5">
      <div class="flex justify-end">
        <span class="inline-flex rounded-md shadow-sm">
          <button type="button" class="py-2 px-4 border border-gray-300 rounded-md text-sm leading-5 font-medium text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-50 active:text-gray-800 transition duration-150 ease-in-out">
            Cancel
          </button>
        </span>
        <span class="ml-3 inline-flex rounded-md shadow-sm">
          <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
            Save
          </button>
        </span>
      </div>
    </div>
  </form>
</div>
@endsection

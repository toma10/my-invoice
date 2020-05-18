@extends('layouts.app')

@section('content')
<header>
  <div class="flex justify-between items-center border-b border-gray-200 pb-6">
    <h2 class="text-3xl font-bold leading-tight text-gray-900">
      Edit Profile
    </h2>
  </div>
</header>
<div class="mt-12">
  <div>
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
          <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
          <p class="mt-1 text-sm leading-5 text-gray-600">
            Use a permanent address where you can receive mail.
          </p>
        </div>
      </div>
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form action="#" method="POST">
          <div class="border border-gray-100 shadow-md overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label for="name" class="block text-sm font-medium leading-5 text-gray-700">Name</label>
                  <input id="name" name="name" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" required autofocus />
                </div>

                <div class="col-span-6 sm:col-span-4">
                  <label for="email" class="block text-sm font-medium leading-5 text-gray-700">Email</label>
                  <input id="email" name="email" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" required />
                </div>
              </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button class="py-2 px-4 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue active:bg-indigo-600 transition duration-150 ease-in-out">
                Save
              </button>
            </div>
          </div>
        </form>
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
          <h3 class="text-lg font-medium leading-6 text-gray-900">Notifications</h3>
          <p class="mt-1 text-sm leading-5 text-gray-600">
            Decide which communications you'd like to receive.
          </p>
        </div>
      </div>
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form action="#" method="POST">
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <fieldset>
                <legend class="text-base leading-6 font-medium text-gray-900">By Email</legend>
                <div class="mt-4 space-y-4">
                  <div>
                    <div class="flex items-start">
                      <div class="absolute flex items-center h-5">
                        <input id="invoice_approved" name="invoice_approved" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                      </div>
                      <div class="pl-7 text-sm leading-5">
                        <label for="invoice_approved" class="font-medium text-gray-700">Invoice approved</label>
                        <p class="text-gray-500">Get notified when someones posts a comment on a posting.</p>
                      </div>
                    </div>
                  </div>
                  <div>
                    <div class="flex items-start">
                      <div class="absolute flex items-center h-5">
                        <input id="invoice_denied" name="invoice_denied" type="checkbox" class="form-checkbox h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" />
                      </div>
                      <div class="pl-7 text-sm leading-5">
                        <label for="invoice_denied" class="font-medium text-gray-700">Invoice denied</label>
                        <p class="text-gray-500">Get notified when a candidate applies for a job.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
              <button class="py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 shadow-sm hover:bg-indigo-500 focus:outline-none focus:shadow-outline-blue focus:bg-indigo-500 active:bg-indigo-600 transition duration-150 ease-in-out">
                Save
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
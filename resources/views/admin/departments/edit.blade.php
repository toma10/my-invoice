@extends('layouts.admin')

@section('content')
<header>
  <div class="flex justify-between items-center border-b border-gray-200 pb-6">
    <h2 class="text-3xl font-bold leading-tight text-gray-900">
      Edit Department
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
              Basic department information.
            </p>
          </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
          <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 lg:col-span-3">
                  <label for="name" class="block text-sm font-medium leading-5 text-gray-700">
                    Name
                  </label>
                  <input id="name" name="name" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" required autofocus />
                </div>

                <div class="hidden lg:block lg:col-span-3"></div>

                <div class="col-span-6 lg:col-span-3">
                  <label for="slug" class="block text-sm font-medium leading-5 text-gray-700">
                    Slug
                  </label>
                  <input id="slug" name="slug" class="mt-1 form-input block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" required autofocus />
                </div>

                <div class="hidden lg:block lg:col-span-3"></div>
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

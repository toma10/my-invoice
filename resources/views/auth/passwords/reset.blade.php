@extends('layouts.auth')

@section('content')
<div class="sm:mx-auto sm:w-full sm:max-w-md">
  <h2 class="mt-3 text-3xl font-extrabold leading-9 text-center text-gray-900">
    Reset Password
  </h2>
  </p>
</div>

<div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
  <div class="px-4 py-8 bg-white shadow sm:rounded-lg sm:px-10">
    <form action="#" method="POST">
      <div class="space-y-6">
        <div>
          <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
            Email
          </label>
          <div class="mt-1 rounded-md shadow-sm">
            <input id="email" name="email" type="email" class="block w-full px-3 py-2 placeholder-gray-400 transition duration-150 ease-in-out border border-gray-300 rounded-md appearance-none focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5" required autofocus />
          </div>
        </div>

        <div>
          <label for="password" class="block text-sm font-medium leading-5 text-gray-700">
            Password
          </label>
          <div class="mt-1 rounded-md shadow-sm">
            <input id="password" name="password" type="password" class="block w-full px-3 py-2 placeholder-gray-400 transition duration-150 ease-in-out border border-gray-300 rounded-md appearance-none focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5" autocomplete="new-password" required />
          </div>
        </div>

        <div>
          <label for="password-confirm" class="block text-sm font-medium leading-5 text-gray-700">
            Confirm Password
          </label>
          <div class="mt-1 rounded-md shadow-sm">
            <input id="password-confirm" name="password_confirmation" type="password" class="block w-full px-3 py-2 placeholder-gray-400 transition duration-150 ease-in-out border border-gray-300 rounded-md appearance-none focus:outline-none focus:shadow-outline-blue focus:border-blue-300 sm:text-sm sm:leading-5" autocomplete="new-password" required />
          </div>
        </div>

        <div>
          <span class="block w-full rounded-md shadow-sm">
            <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white transition duration-150 ease-in-out bg-indigo-600 border border-transparent rounded-md hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700">
              Reset Password
            </button>
          </span>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

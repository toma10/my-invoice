@extends('layouts.app')

@section('content')
<header>
  <div class="flex justify-between items-center border-b border-gray-200 pb-6">
    <h2 class="text-3xl font-bold leading-tight text-gray-900">
      My Profile
    </h2>
    <a href="{{ route('profile.edit') }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium leading-5 text-white transition duration-150 ease-in-out bg-indigo-500 border border-transparent rounded-md hover:bg-indigo-400 focus:outline-none focus:shadow-outline-indigo focus:border-indigo-600 active:bg-indigo-600">
      <svg class="w-5 h-5 mr-2 -ml-1" fill="currentColor" viewBox="0 0 20 20">
        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
      </svg>
      <span>Edit</span>
    </a>
  </div>
</header>
<div class="mt-12">
  <div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="bg-white px-4 py-5 border-b border-gray-200 sm:px-6">
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <img class="h-12 w-12 rounded-full" src="https://www.gravatar.com/avatar/7abeb9188ad670ecfac0ecdbdb8199e4?d=mp&s=80" alt="Avatar" />
        </div>
        <div class="ml-4">
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            Tomáš Máčala
          </h3>
          <p class="text-sm leading-5 text-gray-500">
            tomas.macala@seznam.cz
          </p>
        </div>
      </div>
    </div>
    <div>
      <dl>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Notifications
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
          </dd>
        </div>
        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Role
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
            Administrator
          </dd>
        </div>
        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
          <dt class="text-sm leading-5 font-medium text-gray-500">
            Created
          </dt>
          <dd class="mt-1 text-sm leading-5 text-gray-900 sm:mt-0 sm:col-span-2">
            May 20, 2020
          </dd>
        </div>
      </dl>
    </div>
  </div>
</div>
@endsection

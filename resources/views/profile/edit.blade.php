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
  <x-form :action="route('profile.update')" method="PUT">
    <x-form-panel
      title="Personal Information"
      subtitle="Use a permanent address where you can receive mail."
    >
      <div class="col-span-6 sm:col-span-3">
        <x-text-field
          name="name"
          label="Name"
          :value="$user->name"
          required
          autofocus
        />
      </div>

      <div class="col-span-6 sm:col-span-4">
        <x-text-field
          name="email"
          type="email"
          label="Email"
          :value="$user->email"
          required
        />
      </div>

      <x-slot name="footer">
        <x-button>Save</x-button>
      </x-slot>
    </x-form-panel>
  </x-form>

  <x-form-panel-divider />

  <x-form :action="route('password.change')" method="PUT">
    <x-form-panel
      title="Change password"
      subtitle="Change your current password."
    >
      <x-hidden-field name="email" :value="$user->email" />

      <div class="col-span-6 sm:col-span-3">
        <x-text-field
          name="current_password"
          type="password"
          label="Current Password"
          required
        />
      </div>

      <div class="hidden sm:block sm:col-span-3"></div>

      <div class="col-span-6 sm:col-span-3">
        <x-text-field
          name="password"
          type="password"
          label="New Password"
          autocomplete="new-password"
          required
        />
      </div>

      <div class="hidden sm:block sm:col-span-3"></div>

      <div class="col-span-6 sm:col-span-3">
        <x-text-field
          name="password_confirmation"
          type="password"
          label="Confirm Password"
          autocomplete="new-password"
          required
        />
      </div>

      <x-slot name="footer">
        <x-button>Save</x-button>
      </x-slot>
    </x-form-panel>
  </x-form>

  <x-form-panel-divider />

  <x-form action="#">
    <x-form-panel
      title="Notifications"
      subtitle="Decide which communications you'd like to receive."
    >
      <div class="col-span-6">
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

      <x-slot name="footer">
        <x-button>Save</x-button>
      </x-slot>
    </x-form-panel>
  </x-form>
</div>
@endsection

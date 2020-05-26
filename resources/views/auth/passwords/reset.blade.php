@extends('layouts.auth')

@section('content')
<x-auth.title>Reset Password</x-auth.title>

<x-auth.panel>
  <x-form :action="route('password.update')">
    <x-hidden-field name="email" :value="$email" />

    <div class="space-y-6">
      <x-text-field
        type="password"
        name="password"
        label="Password"
        autocomplete="new-password"
        required
      />

      <x-text-field
        type="password"
        name="password_confirmation"
        label="Confirm Password"
        autocomplete="new-password"
        required
      />

      <x-button full-width>Reset Password</x-button>
    </div>
  </x-form>
</x-auth.panel>
@endsection

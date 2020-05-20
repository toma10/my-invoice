@extends('layouts.auth')

@section('content')
<x-auth.title>Setup Account</x-auth.title>

<x-auth.panel>
  <x-form :action="route('users.setupAccount')">
    <div class="space-y-6">
      <x-text-field type="email" name="email" label="Email" required autofocus />
      <x-text-field type="password" name="password" label="Password" autocomplete="new-password" required />
      <x-text-field type="password" name="password_confirmation" label="Confirm Password" autocomplete="new-password" required />
      <x-hidden-field name="token" :value="$token" />
      <x-button full-width>Setup Account</x-button>
    </div>
  </x-form>
</x-auth.panel>
@endsection

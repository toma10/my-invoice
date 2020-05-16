@extends('layouts.auth')

@section('content')
<x-auth.title>Setup Account</x-auth.title>

<x-auth.panel>
  <x-form.form :action="route('users.setupAccount')">
    <div class="space-y-6">
      <x-form.text-field type="email" name="email" label="Email" required autofocus />
      <x-form.text-field type="password" name="password" label="Password" autocomplete="new-password" required />
      <x-form.text-field type="password" name="password_confirmation" label="Confirm Password" autocomplete="new-password" required />
      <x-form.hidden-field name="token" :value="$token" />
      <x-form.button>Setup Account</x-form.button>
    </div>
  </x-form.form>
</x-auth.panel>
@endsection

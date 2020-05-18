@extends('layouts.auth')

@section('content')
<x-auth.title>Sign in to {{ config('app.name') }}</x-auth.title>

<x-auth.panel>
  <x-form :action="route('login')">
    <div class="space-y-6">
      <x-text-field type="email" name="email" label="Email" required autofocus />
      <x-text-field type="password" name="password" label="Password" required />
      <div class="flex items-center justify-between">
        <x-checkbox-field name="remember" label="Remember me" />
        <x-link :href="route('password.request')">Forgot your password?</x-link>
      </div>
      <x-button full-width>Sign In</x-button>
    </div>
  </x-form>
</x-auth.panel>
@endsection

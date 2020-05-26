@extends('layouts.auth')

@section('content')
<x-auth.title>Reset Password</x-auth.title>

<x-auth.panel>
  <x-form :action="route('password.email')">
    <div class="space-y-6">
      <x-text-field
        type="email"
        name="email"
        label="Email"
        required
        autofocus
      />

      <x-button full-width>Send Password Reset Link</x-button>
    </div>
  </x-form>
</x-auth.panel>
@endsection

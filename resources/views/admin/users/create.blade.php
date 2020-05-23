@extends('layouts.admin')

@section('content')
<x-page-header>
  <x-page-title>Invite User</x-page-title>
</x-page-header>
<div class="mt-12">
  <x-form :action="route('admin.users.invite')">
    <x-form-panel
      title="Information"
      subtitle="Basic user information."
    >
      <div class="col-span-6 sm:col-span-4">
        <x-text-field
          name="email"
          label="Email"
          required
          autofocus
        />
      </div>
    </x-form-panel>

    <x-form-buttons />
  </x-form>
</div>
@endsection

@extends('layouts.app')

@section('content')
<x-page-header>
  <div class="flex items-center space-x-3">
    <x-page-title>{{ $user->name }}</x-page-title>
    <x-user-state :user="$user" size="md" />
  </div>
  @if ($user->isAdmin())
    <x-form :action="route('admin.demoteUser')" method="DELETE">
      <x-hidden-field name="user_id" :value="$user->id" />
      <x-button variant="plain">Demote to User</x-button>
    </x-form>
  @else
    <x-form :action="route('admin.promoteUser')">
      <x-hidden-field name="user_id" :value="$user->id" />
      <x-button variant="plain">Promote to Admin</x-button>
    </x-form>
  @endif
</x-page-header>
<div class="mt-12">
  @include('profile.partials._info')

  <div class="mt-8 border-t border-gray-200 pt-5">
    <div class="flex justify-end space-x-3">
      @if ($user->isActive())
        <x-confirm-modal
          :action="route('admin.deactivateUser')"
          title="Deactivate User"
          body="Are you sure you want to deactivate user?"
        >
          <x-hidden-field name="user_id" :value="$user->id" />
          <x-button type="button" @click="$dispatch('open')">Deactivate</x-button>
        </x-confirm-modal>
      @else
        <x-confirm-modal
          :action="route('admin.activateUser')"
          title="Activate User"
          body="Are you sure you want to activate user?"
        >
          <x-hidden-field name="user_id" :value="$user->id" />
          <x-button type="button" @click="$dispatch('open')">Activate</x-button>
        </x-confirm-modal>
      @endif
    </div>
  </div>
</div>
@endsection

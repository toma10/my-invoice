@extends('layouts.admin')

@section('content')
<x-page-header>
  <x-page-title>Users</x-page-title>
  <x-create-button-link :href="route('admin.users.invite')">Invite User</x-create-button-link>
</x-page-header>
<div class="mt-12">
  @include('admin.users.partials._list')
</div>
@endsection

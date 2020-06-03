@extends('layouts.app')

@section('content')
<x-page-header>
  <x-page-title>My Profile</x-page-title>
  <x-edit-button-link :href="route('profile.edit')">Edit</x-edit-button-link>
</x-page-header>
<div class="mt-12">
  @include('profile.partials._info')
</div>
@endsection

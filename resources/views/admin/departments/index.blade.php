@extends('layouts.admin')

@section('content')
<x-page-header>
  <x-page-title>Departments</x-page-title>
  <x-create-button-link :href="route('admin.departments.create')">New Department</x-create-button-link>
</x-page-header>
<div class="mt-12">
  @include('admin.departments.partials._list')
</div>
@endsection

@extends('layouts.admin')

@section('content')
<x-page-header>
  <x-page-title>Edit Department</x-page-title>
</x-page-header>
<div class="mt-12">
  <x-form :action="route('admin.departments.update', $department)" method="PUT">
    @include('admin.departments.partials._form')
  </x-form>
</div>
@endsection

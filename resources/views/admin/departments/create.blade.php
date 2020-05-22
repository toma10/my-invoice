@extends('layouts.app')

@section('content')
<x-page-header>
  <x-page-title>New Department</x-page-title>
</x-page-header>
<div class="mt-12">
  <x-form :action="route('admin.departments.store')">
    @include('admin.departments.partials._form')
  </x-form>
</div>
@endsection

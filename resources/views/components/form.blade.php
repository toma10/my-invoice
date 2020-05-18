@props(['action', 'method'])

<form method="POST" action="{{ $action }}" {{ $attributes }}>
  @csrf
  @isset($method)
    @method($method)
  @endisset
  {{ $slot }}
</form>

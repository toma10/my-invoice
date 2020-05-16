@props(['action', 'method'])

<form method="POST" action="{{ $action }}">
  @csrf
  @isset($method)
    @method($method)
  @endisset
  {{ $slot }}
</form>

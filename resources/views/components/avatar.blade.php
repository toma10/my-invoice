@props(['src', 'size'])

@php
  $sizes = [
    'sm' => 'w-8 h-8',
    'md' => 'w-10 h-10',
    'lg' => 'w-12 h-12',
  ]
@endphp

<img class="{{ $sizes[$size] }} rounded-full" src="{{ $src }}" alt="Avatar" />

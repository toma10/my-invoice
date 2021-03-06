@props(['href'])

<x-icon-button-link :href="$href">
  <x-slot name="icon">
    <x-heroicon-s-plus />
  </x-slot>
  {{ $slot }}
</x-icon-button-link>

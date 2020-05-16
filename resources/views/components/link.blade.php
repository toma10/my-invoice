@props(['href'])

<a href="{{ $href }}" class="text-sm font-medium leading-5 text-indigo-600 transition duration-150 ease-in-out hover:text-indigo-500 focus:outline-none focus:underline">
  {{ $slot }}
</a>

@props(['aligtRight' => false])

<td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500 space-x-2 {{ $aligtRight ? 'text-right' : 'text-left' }}">
  {{ $slot }}
</td>

<nav class="grid grid-cols-2 gap-1 lg:gap-0 lg:block space-y-0 lg:space-y-1">
  <x-admin-navigation-link href="{{ route('admin.dashboard') }}" exact>
    <x-slot name="icon">
      <x-heroicon-o-home />
    </x-slot>
    Dashboard
  </x-admin-navigation-link>

  <x-admin-navigation-link href="{{ route('admin.users.index') }}">
    <x-slot name="icon">
      <x-heroicon-o-user-group />
    </x-slot>
    Users
  </x-admin-navigation-link>

  <x-admin-navigation-link href="{{ route('admin.departments.index') }}">
    <x-slot name="icon">
      <x-heroicon-o-home />
    </x-slot>
    Departmentss
  </x-admin-navigation-link>

  <x-admin-navigation-link href="{{ route('admin.invoices.index') }}">
    <x-slot name="icon">
      <x-heroicon-o-currency-dollar />
    </x-slot>
    Invoices
  </x-admin-navigation-link>
</nav>

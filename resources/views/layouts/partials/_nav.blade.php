<nav class="bg-gray-800" x-data="{ mobileMenuOpen: false }">
  <x-container>
    <div class="flex justify-between h-16">
      <div class="flex">
        <div class="flex items-center mr-2 -ml-2 md:hidden">
          <button
            class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white"
            aria-label="Main menu"
            aria-expanded="false"
            @click="mobileMenuOpen = !mobileMenuOpen"
          >
            <span x-show="!mobileMenuOpen">
              <x-heroicon-s-menu class="w-6 h-6" />
            </span>
            <span x-show="mobileMenuOpen">
              <x-heroicon-s-x class="w-6 h-6" />
            </span>
          </button>
        </div>
        <div class="flex items-center flex-shrink-0">
          <a href="{{ route('invoices.index') }}">
            <h1 class="font-bold text-white">{{ config('app.name') }}</h1>
          </a>
        </div>
        <div class="hidden md:ml-6 md:flex md:items-center space-x-4">
          @if (auth()->user()->isAdmin())
            <x-navigation-link :href="route('admin.dashboard')">Administration</x-navigation-link>
          @endif
          <x-navigation-link :href="route('invoices.index')">My Invoices</x-navigation-link>
        </div>
      </div>
      <div class="flex items-center">
        <div class="hidden md:ml-4 md:flex-shrink-0 md:flex md:items-center">
          <button class="p-1 text-gray-400 transition duration-150 ease-in-out border-2 border-transparent rounded-full hover:text-gray-300 focus:outline-none focus:text-gray-500 focus:bg-gray-100" aria-label="Notifications">
            <x-heroicon-o-bell class="w-6 h-6" />
          </button>

          <div class="relative ml-3" x-data="{ userMenuOpen: false }">
            <div>
              <button
                class="flex text-sm transition duration-150 ease-in-out border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300"
                id="user-menu"
                aria-label="User menu"
                aria-haspopup="true"
                @click="userMenuOpen = true"
                x-on:keydown.escape="userMenuOpen = false"
              >
                <x-avatar size="sm" :src="auth()->user()->avatarUrl()" />
              </button>
            </div>
            <div
              class="z-50 absolute right-0 w-48 mt-2 origin-top-right rounded-md shadow-lg"
              x-show="userMenuOpen"
              x-transition:enter="transition ease-out duration-200"
              x-transition:enter-start="opacity-0 scale-95"
              x-transition:enter-end="transform opacity-100 scale-100"
              x-transition:leave="transition ease-in duration-75"
              x-transition:leave-start="transform opacity-100 scale-100"
              x-transition:leave-end="transform opacity-0 scale-95"
              @click.away="userMenuOpen = false"
            >
              <div
                class="py-1 bg-white rounded-md shadow-xs"
                role="menu"
                aria-orientation="vertical"
                aria-labelledby="user-menu"
              >
                <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:bg-gray-100">My Profile</a>
                <a
                  href="{{ route('logout') }}"
                  class="block px-4 py-2 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:outline-none focus:bg-gray-100"
                  @click.prevent="$refs.logoutForm.submit()"
                >
                  Sign out
                </a>
                <x-form :action="route('logout')" class="hidden" x-ref="logoutForm" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="md:hidden" x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false">
    <div class="px-2 pt-2 pb-3 sm:px-3 space-y-1">
      @if (auth()->user()->isAdmin())
        <x-mobile-navigation-link :href="route('admin.dashboard')">Administration</x-mobile-navigation-link>
      @endif
      <x-mobile-navigation-link :href="route('invoices.index')">My Invoices</x-mobile-navigation-link>
    </div>
    <div class="pt-4 pb-3 border-t border-gray-700">
      <div class="flex items-center px-5 sm:px-6">
        <div class="flex-shrink-0">
          <x-avatar size="md" :src="auth()->user()->avatarUrl()" />
        </div>
        <div class="ml-3">
          <div class="text-base font-medium leading-6 text-white">{{ auth()->user()->name }}</div>
          <div class="text-sm font-medium leading-5 text-gray-400">{{ auth()->user()->email }}</div>
        </div>
      </div>
      <div class="px-2 mt-3 sm:px-3 space-y-1">
        <x-mobile-navigation-link :href="route('profile.show')">My Profile</x-mobile-navigation-link>
        <x-mobile-navigation-link :href="route('logout')" @click.prevent="$refs.logoutForm.submit()">Sign out</x-mobile-navigation-link>
        <x-form :action="route('logout')" class="hidden" x-ref="logoutForm" />
      </div>
    </div>
  </x-container>
</nav>

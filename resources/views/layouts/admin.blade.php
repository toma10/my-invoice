<!DOCTYPE html>
<html lang="en">
@include('layouts.partials._head')
<body class="bg-gray-100 antialiased">
  <header>
    @include('layouts.partials._nav')
  </header>
  <main>
    <x-container>
      <div class="py-10">
        @include('layouts.partials._flash')
        <div class="lg:grid lg:grid-cols-12 lg:col-gap-12 space-y-8 lg:space-y-0">
          <div class="lg:col-span-3 xl:col-span-2">
            @include('layouts.partials.admin._nav')
          </div>
          <div class="lg:col-span-9 xl:col-span-10">
            @yield('content')
          </div>
        </div>
      </div>
    </x-container>
  </main>
</body>
</html>

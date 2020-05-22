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
        @yield('content')
      </div>
    </x-container>
  </main>
</body>
</html>

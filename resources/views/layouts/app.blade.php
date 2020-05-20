<!DOCTYPE html>
<html lang="en">
@include('layouts.partials._head')
<body class="bg-gray-100 antialiased">
  <header>
    @include('layouts.partials._nav')
  </header>
  <main>
    <div class="py-10 max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
      @include('layouts.partials._flash')
      @yield('content')
    </div>
  </main>
</body>
</html>

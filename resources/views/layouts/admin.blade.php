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

      <div class="lg:flex lg:space-x-12 space-y-8 lg:space-y-0">
        <div class="lg:w-56 lg:flex-shrink-0">
          @include('layouts.partials.admin._nav')
        </div>
        <div class="lg:flex-1">
          @yield('content')
        </div>
      </div>
    </div>
  </main>
</body>
</html>

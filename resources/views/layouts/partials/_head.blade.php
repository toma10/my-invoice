<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @hasSection('title')
    <title>@yield('title') | {{ config('app.name') }}</title>
  @else
    <title>{{ config('app.name') }}</title>
  @endif
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  <script src="{{ mix('js/app.js') }}"></script>
</head>

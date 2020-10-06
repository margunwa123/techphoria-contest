<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  @include('layouts.head')
</head>
<body id="app">
  {{-- Wrapper for sticky footer --}}
  <div id="wrapper">
    @include('layouts.navbar')
    <div id="content">
        @yield('content')
    </div>
  </div>
  @include('layouts.footer')
</body>
</html>

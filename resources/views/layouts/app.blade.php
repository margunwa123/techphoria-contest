<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.head')
</head>
<body>
    <div id="app">
      {{-- Wrapper for sticky footer --}}
      <div id="wrapper">
        @include('layouts.navbar')
        <div id="content">
            @yield('content')
        </div>
      </div>
      @include('layouts.footer')
    </div>
</body>
</html>

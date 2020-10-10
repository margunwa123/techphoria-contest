@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-12 d-flex">
        <h1 class="title">@yield('page-title')</h1>
        @yield('page-subtitle')
        @yield('delete-form')
      </div>
    </div>
    <hr class="bg-orange"/>
    @yield('page-content')
    @yield('others')
  </div>
@endsection
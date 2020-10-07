@extends('layouts.app')

{{--
  PARAMS:
  - page-title
  - page-subtitle
  - page-items
  - others
  --}}

@section('content')
  <div class="container">
    @include('utilities.error')
    <div class="row">
      <div class="col-12 d-flex">
        <h1 class="title">@yield('page-title')</h1>
      </div>
      @yield('page-subtitle')
    </div>
    <hr class="bg-orange"/>
    <div class="row mx-2">
      @yield('page-items')
    </div>
    @yield('others')
  </div>
@endsection
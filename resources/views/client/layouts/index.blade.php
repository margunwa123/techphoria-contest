@extends('layouts.app')

@section('content')
  <div class="container">
    @include('utilities.error')
    <div class="row">
      <div class="col-12 d-flex">
        <h1 class="title">@yield('page-title')</h1>
        <div class="ml-auto">
          <a href="@yield('create-route')" class="btn btn-primary">Buat @yield('model-name')</a>
        </div>
      </div>
      @yield('page-subtitle')
    </div>
    <hr class="bg-orange"/>
    <div class="row">
      @yield('page-items')
    </div>
    @yield('others')
  </div>
@endsection
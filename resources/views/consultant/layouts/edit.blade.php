@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <h1 class="title">@yield('page-title')</h1>
      <div class="ml-auto">
        <a href="@yield('index-route')" class="btn btn-warning">Cancel</a>
      </div>
    </div>
    <hr class="bg-orange"/>
    @include ('utilities.error')
    <form method="POST" action="@yield('update-route')">
      <div class="card">
        @csrf
        @method('PUT')
        @yield('form-items')
        <div class="card-footer d-flex justify-content-center">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </form>
    @yield('others')
  </div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
  <section class="px-2">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner w-100">
        <div class="carousel-item active">
          <img src="/storage/default.jpg" alt="First slide">
        </div>
        <div class="carousel-item">
          <img src="/storage/default.jpg" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img src="https://pbs.twimg.com/profile_images/1068577980971016197/yAshQPMf.jpg" alt="Third slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </section>
</div>
@endsection

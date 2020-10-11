@extends('layouts.app')

@section('content')
<div class="hero-container">
    <div class="container position-relative h-100">
        <img class="hero-logo" src="{{URL::asset("asset/vinaid-text.svg")}}" />
        <h1 class="hero-text">
            Platform yang mempertemukan konsultan keuangan dengan perusahaan
        </h1>

        <img class="hero-bars" src="{{URL::asset("asset/landing/hero-bars.svg")}}" />
    </div>
</div>
<div class="aid-container">
    <div class="container">
        <div class="about row">
            <div class="col-4">
                <img class="about-logo" src="{{URL::asset("asset/vinaid-logo.png")}}" />
            </div>
            <div class="col-8 about-text">
                <h1 class="text-darkblue font-weight-bolder">
                    What are we?
                </h1>
                <h5 class="about-desc">
                    VinAid adalah sebuah platform untuk mempertemukan para financial aid consultant dengan start up companies yang sedang mencari bantuan finansial. Dengan Vinaid, baik konsultan maupun perusahaan tidak perlu dengan sulit saling mencari.
                </h5>
                <div class="btn btn-primary btn-lg about-btn">
                    <h4> Kenali lebih lanjut </h4>
                </div>
            </div>
        </div>
        <div class="row pb-lg-5">
            <h1 class="text-darkblue font-weight-bold mx-auto text-center my-10">
                Financial Aid
            </h1>
            <div class="row">
                <div class="col d-flex flex-column align-items-center aid-col">
                    <img class="aid-logo" src="{{URL::asset("asset/landing/cepat.png")}}" />
                    <h3 class="text-darkgreen p-4 font-weight-bolder">Cepat</h3>
                    <p class="text-center text-sm px-5">Kita semua tahu hal terpenting dalam bisnis adalah waktu. Jangan buang buang waktu anda mencari konsultan yang terpercaya saat anda bisa mendapatkannya lewat VinAid
                    </p>
                </div>
                <div class="col d-flex flex-column align-items-center aid-col">
                    <img class="aid-logo p-3" src="{{URL::asset("asset/landing/nego.png")}}" />
                    <h3 class="text-darkgreen p-4 font-weight-bolder">Murah</h3>
                    <p class="text-center text-sm px-5">Harga bisa dinegosiasikan dengan antara konsultan dengan klien sehingga kedua belah pihak dapat diuntungkan
                    </p>
                </div>
                <div class="col d-flex flex-column align-items-center aid-col">
                    <img class="aid-logo p-2" src="{{URL::asset("asset/landing/praktis.png")}}" />
                    <h3 class="text-darkgreen p-4 font-weight-bolder">Praktis</h3>
                    <p class="text-center text-sm px-5">Anda bisa memilih konsultan sendiri atau buat permintaan dan menunggu konsultan hadir kepada anda, praktis bukan?
                    </p>
                </div>
            </div>
        </div>
        @if (is_null(Auth::user()) ? true :  Auth::user()->role == "client")
          <div class="aid-card-container   background-color-red">
              <div class="left-content-container">
                  <img src="{{ URL::asset("asset/card-img1.png") }}">
              </div>
              <div class="right-content-container ">
                  <h2>Let’s start by building your own company profile</h2>
                  <p>Join our community to start getting support from our professionals</p>
                  <div class="btn btn-primary btn-lg about-btn">
                      <a href="{{ route('client.company.create') }}">
                          Get Started
                      </a>
                  </div>
              </div>
          </div>
        @endif
        @if (is_null(Auth::user()) ? true :  Auth::user()->role == "consultant")
          <div class="aid-card-container background-color-blue">
              <div class="left-content-container">
                  <h2>We make it easy for consultant to find projects</h2>
                  <p>Your hardwork, projects, and rating will promote yourself to the top page</p>
                  <div class="btn-container">
                      <div class="btn btn-primary btn-lg about-btn">
                          <a href="/register">
                              Join Our Community
                          </a>
                      </div>
                  </div>
              </div>
              <div class="right-content-container">
                  <img src="{{ URL::asset("asset/card-img2.png") }}">
              </div>
          </div>            
        @endif
    </div>
</div>
@endsection

@extends('client.layouts.index')

@section('page-title', 'Konsultan')

@section('page-subtitle')
<div class="d-flex col-12">
  <p class="text-muted font-italic">Lihat daftar konsultan untuk membuat permintaan personal</p>
</div>
@endsection

@section('model-name', 'Konsultan')

@section('page-items')
@foreach ($consultants as $consultant)
  <div class="col-md-4 mb-3">
    <div class="card">
      <div class="card-header bg-primary py-4 text-white">
        <i class="fas fa-star  text-yellow"></i>
        Rating : {{$consultant->rating}}/5
      </div>
      <div class="card-body">
        <div class="d-flex">
          <div class="">
            <h4>{{ $consultant->user->name }}</h4>
            <p>Spesialisasi: {{ $consultant->finance_type }}</p>
          </div>
        </div>
        <a href="{{ route('consultant.profile.show', $consultant->id) }}" class="btn btn-primary">view</a>
      </div>
    </div>
  </div>
@endforeach
@endsection
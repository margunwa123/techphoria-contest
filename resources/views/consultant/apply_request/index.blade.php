@extends('consultant.layouts.index')

@section('page-title', 'Menawarkan Jasa Konsultasi')
    
@section('page-subtitle')
<div class="col-12 d-flex">
  <p ><span class="text-muted font-italic">Tunggu perusahaan menerima permintaan anda, sembari menunggu </span> 
  <a href="{{route('consultant.request.index')}}" class="btn btn-primary ml-3">Jelajahi Permintaan Pengguna</a></p>
</div>
@endsection

@section('page-items')
@foreach ($applyRequests as $applyRequest)
<div class="col-12 applyRequest mb-3">
  <div data-toggle="collapse" href="#apply-request-{{ $loop->index }}" role="button" aria-expanded="false" aria-controls="collapseExample{{ $loop->index }}" class="card bg-primary hoverable text-decoration-none">
    <div class="card-body text-white d-flex">
      <div class="">
        <h1>Penawaran jasa ke {{ $applyRequest->request->company->name }}</h1>
      </div>
      <div class="ml-auto d-flex align-items-center">
        <form action="{{ route('consultant.apply_request.destroy', $applyRequest->id) }}" onsubmit="deleteCompany" method="POST" id="delete-applyRequest-{{ $applyRequest->id }}">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger">
            <i class="fas fa-trash"></i>
          </button>
        </form>
      </div>
    </div>
  </div>
  <div class="collapse" id="apply-request-{{ $loop->index }}">
    <div class="card card-body">
      <div>
        <div class="">
          Title : <input readonly value="{{ $applyRequest->title }}" class="form-control">
        </div>
        <div class="">
          Body : <textarea rows="3" readonly class="form-control">{{ $applyRequest->body }}</textarea>
        </div>
      </div>
    </div>
  </div>
</div>

@endforeach
@if (count($applyRequests) == 0)
<div class="text-center col-12">
  <span class="font-italic text-muted">Kamu belum membuat perusahaan, buat sekarang!</span>
</div>
@endif
@endsection

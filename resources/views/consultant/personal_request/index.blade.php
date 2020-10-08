@extends('consultant.layouts.index')

@section('page-title', 'Permintaan khusus ke anda')

@section('page-items')
@foreach ($personalRequests as $personalRequest)
<div class="col-12 mb-3">
  <div class="col-12 personalRequest mb-3">
    <div data-toggle="collapse" href="#personal-request-{{ $loop->index }}" role="button" aria-expanded="false" aria-controls="personal-request-{{ $loop->index }}" class="card bg-main hoverable text-decoration-none">
      <div class="card-body text-white d-flex">
        <div class="">
          <h1>Perusahaan {{ $personalRequest->company->name }}</h1>
        </div>
        <div class="ml-auto d-flex align-items-center">
          <form action="{{ route('client.personalRequest.destroy', $personalRequest->id) }}" onsubmit="deletePersonalRequest" method="POST" id="delete-personalRequest-{{ $personalRequest->id }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
              <i class="fas fa-trash"></i>
            </button>
          </form>
        </div>
      </div>
    </div>
    <div class="collapse" id="personal-request-{{ $loop->index }}">
      <div class="card">
        <div class="card-body">
          <p>Bidang Keuangan : {{ $personalRequest->finance_type }}</p>
          <p>Deskripsi : {{ $personalRequest->description }}</p>
          <p>Budget : {{ $personalRequest->fee }}</p>
        </div>
        <div class="card-footer d-flex justify-content-center">
          <form action="{{ route('consultant.personal_request.accept', $personalRequest->id) }}" method="post">
            <button type="submit" class="btn btn-success border-50">Terima <i class="fas fa-check"></i></button>
          </form>
          <form action="{{ route('consultant.personal_request.reject', $personalRequest->id) }}" method="post">
            <button type="submit" class="btn btn-success border-50">Terima <i class="fas fa-check"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endforeach
@if (count($personalRequests) == 0)
<div class="text-center col-12">
  <span class="font-italic text-muted">Belum ada permintaan khusus, bangun reputasimu dengan mengerjakan proyek!</span>
</div>
@endif
@endsection
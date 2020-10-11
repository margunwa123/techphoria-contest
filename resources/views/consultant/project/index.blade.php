@extends('consultant.layouts.index')

@section('page-title', 'Proyek')
    
@section('page-subtitle')
<div class="col-12">
  <p class="text-muted font-italic">Proyek yang sedang anda jalani</p>
</div>
@endsection

@section('page-items')
@foreach ($projects as $project)
<div class="col-12 mb-3">
  <div data-toggle="collapse" href="#project-{{ $loop->index }}" role="button" aria-expanded="false" aria-controls="project-{{ $loop->index }}" class="card bg-main hoverable text-decoration-none">
    <div class="card-body text-white">
      <div class="d-flex">
        <div class="">
          <h1>Perusahaan {{ $project->company->name }}</h1>
        </div>
      </div>
      <p >Konsultasi {{$project->finance_type}}</p>
    </div>
  </div>
  <div class="collapse" id="project-{{ $loop->index }}">
    <div class="card">
      <div class="card-body">
        <p>Bidang Keuangan : {{ $project->finance_type }}</p>
        <p>Deskripsi : {{ $project->description }}</p>
        <p>Budget : {{ $project->fee }}</p>
        <p>No Telepon Perusahaan : {{ $project->company->phone }}</p>
      </div>
      <div class="card-footer d-flex justify-content-center">
        <form action="{{ route('consultant.project.cancel', $project->id) }}" method="post">
          @csrf
          <button type="submit" class="btn btn-danger">Batalkan <i class="fas fa-times"></i></button>
        </form>
        <form action="{{ route('consultant.project.destroy', $project->id) }}" method="post">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-success">Tandakan Selesai <i class="fas fa-check"></i></button>
        </form>
      </div>
    </div>
  </div>
</div>
@endforeach

@if (count($projects) == 0)
<div class="text-center col-12">
  <span class="font-italic text-muted">Belum ada permintaan khusus, bangun reputasimu dengan mengerjakan proyek!</span>
</div>
@endif

<h1>Proyek sebelumnya</h1>
<hr class="bg-main">
@foreach ($completedProjects as $project)
<div class="col-12 mb-3">
  <div data-toggle="collapse" href="#completed-project-{{ $loop->index }}" role="button" aria-expanded="false" aria-controls="completed-project-{{ $loop->index }}" class="card bg-green hoverable text-decoration-none">
    <div class="card-body text-white">
      <div class="d-flex">
        <div class="">
          <h1>Perusahaan {{ $project->company->name }}</h1>
        </div>
      </div>
      <p >Konsultasi {{$project->finance_type}}</p>
    </div>
  </div>
  <div class="collapse" id="completed-project-{{ $loop->index }}">
    <div class="card">
      <div class="card-body">
        <p>Bidang Keuangan : {{ $project->finance_type }}</p>
        <p>Deskripsi : {{ $project->description }}</p>
        <p>Budget : {{ $project->fee }}</p>
        <p>No Telepon Perusahaan : {{ $project->company->phone }}</p>
      </div>
    </div>
  </div>
</div>
@endforeach
@endsection
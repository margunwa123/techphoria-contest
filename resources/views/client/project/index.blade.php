@extends('client.layouts.index')

@section('page-title', 'Proyek')
    
@section('page-subtitle')
<div class="col-12">
  <p class="text-muted font-italic">Proyek yang sedang anda jalani</p>
</div>
@endsection

@section('page-items')
@foreach ($projects as $project)
<div class="col-12 mb-3">
  <div class="col-12 project mb-3">
    <div data-toggle="collapse" href="#project-{{ $loop->index }}" role="button" aria-expanded="false" aria-controls="project-{{ $loop->index }}" class="card bg-main hoverable text-decoration-none">
      <div class="card-body text-white">
        <div class="d-flex">
          <div class="">
            <h1>Perusahaan {{ $project->company->name }}</h1>
          </div>
        </div>
        <p>Konsultasi {{$project->finance_type}}</p>
      </div>
    </div>
    <div class="collapse" id="project-{{ $loop->index }}">
      <div class="card">
        <div class="card-body">
          <p>Bidang Keuangan : {{ $project->finance_type }}</p>
          <p>Deskripsi : {{ $project->description }}</p>
          <p>Budget : {{ $project->fee }}</p>
          <p>No.HP Konsultan : {{ $project->consultant->user->phone }}</p>
        </div>
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

<div class="col-12">
  <h1 class="title">Proyek Usai</h1>
  <hr class="bg-main">
</div>
@foreach ($companies as $company)
  @foreach ($company->completedProjects as $project)
  <div class="col-12 mb-3">
    <div data-toggle="collapse" href="#completed-project-{{ $loop->index }}" role="button" aria-expanded="false" aria-controls="completed-project-{{ $loop->index }}" class="card bg-green hoverable text-decoration-none">
      <div class="card-body text-white">
        <div class="d-flex">
          <div class="">
            <h1>Konsultasi {{ $project->finance_type }}</h1>
          </div>
        </div>
        Bersama <a target="_blank" href="{{route('consultant.profile.show', $project->consultant->user_id)}}" ><span class="text-dark">{{$project->consultant->user->name}}</span></a>
      </div>
    </div>
    <div class="collapse" id="completed-project-{{ $loop->index }}">
      <div class="card">
        <div class="card-body">
          <p>Bidang Keuangan : {{ $project->finance_type }}</p>
          <p>Deskripsi : {{ $project->description }}</p>
          <p>Budget : {{ $project->fee }}</p>
          <p>No Telepon Konsultan: {{ $project->consultant->user->phone }}</p>
        </div>
      </div>
    </div>
  </div>
  @endforeach
@endforeach
@endsection
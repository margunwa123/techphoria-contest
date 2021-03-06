@extends('client.layouts.show')

@section('page-title')
<i class="fas fa-briefcase text-main"></i>
Perusahaan {{ $company->name }}
@endsection

@section('delete-form')
@can('delete', $company)
<form action="{{route('client.company.destroy', $company->id )}}" method="post">
  @csrf
  @method('DELETE')
  <button class=" btn btn-danger hoverable">
    <i class="fas fa-trash"></i>
    Delete
  </button>
</form>
@endcan
@endsection

@section('model-name', 'Perusahaan')

@section('page-content')
<form action="{{ route('client.company.update', $company->id) }}" method="POST" id="company-{{ $company->id }}" class="text-sm-1 d-flex flex-column gap-5">
  @csrf
  @method('PUT')
  <div class="row">
    <div class="col-4">
      <i class="fas fa-building text-blue"></i>
      Bidang : 
    </div>
    <div class="col-md-8">
      <input class="readonlyinput form-control border-0" readonly name="company_field" value="{{ $company->company_field }}" id="company_field">
    </div>
  </div>
  <div class="row">
    <div class="col-4">
      <i class="fas fa-phone-square"></i>
      Telepon : 
    </div>
    <div class="col-md-8">
      <input class="readonlyinput form-control border-0" readonly name="phone" value="{{ $company->phone }}" id="phone">
    </div>
  </div>
  <div class="row">
    <div class="col-4">
      <i class="fas fa-city text-red"></i>
      Kota : 
    </div>
    <div class="col-md-8">
      <input class="readonlyinput form-control border-0" readonly name="city" value="{{ $company->city }}" id="city">
    </div>
  </div>
  <div class="row">
    <div class="col-4">
      <i class="fas fa-calendar-check text-green"></i>
      Didirikan pada : 
    </div>
    <div class="col-md-8">
      <input class="readonlyinput form-control border-0" readonly name="found_date" value="{{ $company->found_date }}" id="found_date">
    </div>
  </div>
  <div class="row">
    <div class="col-4">
      <i class="fas fa-list text-yellow"></i>
      Deskripsi : 
    </div>
    <div class="col-md-8">
      <input class="readonlyinput form-control border-0" readonly name="description" value="{{ $company->description }}" id="description">
    </div>
  </div>
  
  <div class="d-flex">
    <div id="edit-company-{{ $company->id }}">
      <a role="button" onclick="toggleEditCompany({{$company->id}})" id="edit-company-{{$company->id}}" class="btn btn-warning">Edit</a>
    </div>
    <div class="form-group" id="save-company-{{ $company->id }}" hidden>
      <button type="submit" class="btn btn-primary" >
        Save
      </button>
    </div>
  </div>
</form>

<section id="requests" class="mt-4">
  <div class="card">
    <div class="card-header">
      <div class="d-flex">
        <h2 class="title">Permintaan konsultasi yang anda ajukan : </h2>
        <div class="ml-auto">
          <a href="{{ route('client.request.create') }}" class="btn btn-primary ml-2">
            Buat Permintaan Konsultasi
          </a>
        </div>
      </div>
    </div>
    <div class="card-body">
      @foreach ($requests as $request)
        <div class="">
          <hr class="bg-main">
          <div class="col-md-3 col-sm-6">
            <div class="card">
              <div class="card-body">
                <h3>Request pertama</h3>
                <p>Jenis finansial : Pajak</p>
                <p>Diajukan pada : 2020-02-13</p>
              </div>
            </div>
          </div>
        </div>
      @endforeach
      @if(count($requests) == 0)
      <div>
        <p >
          <span class="text-muted font-italic">Anda belum meminta jasa konsultasi, minta sekarang!</span>
        </p>
      </div>
      @endif
      <div class="d-flex">
        <p class="font-weight-bold">Permintaan konsultasi personal yang anda ajukan : </p>
        <div class="ml-auto">
          <a href="{{ route('client.consultant.index') }}" class="btn btn-secondary ml-2">
            Telusuri Konsultan
          </a>
        </div>
      </div>
      @foreach ($personalRequests as $request)
        <div class="">
          <hr class="bg-main">
          <div class="col-md-3 col-sm-6">
            <div class="card">
              <div class="card-body">
                <h3>Request pertama</h3>
                <p>Jenis finansial : Pajak</p>
                <p>Diajukan pada : 2020-02-13</p>
              </div>
            </div>
          </div>
        </div>
      @endforeach
      @if(count($personalRequests) == 0)
        <p >
          <span class="text-muted font-italic">Coba lihat lihat konsultan dengan ratingnya untuk mendapatkan konsultan yang sesuai</span>
        </p>
      @endif
    </div>
  </div>

</section>

<section id="projects" class="mt-4">
  <div class="card">
    <div class="card-header bg-primary text-white">
      <div class="d-flex">
        <h2 class="title">Proyek</h2>
      </div>
    </div>
    <div class="card-body">
      <hr class="bg-main">
      @foreach ($projects as $project)
        <div class="col-md-3 col-sm-6">
          <div class="card">
            <div class="card-body">
              <h3>Konsultan {{ $project->consultant->user->name }}</h3>
              <p>Jenis finansial : {{ $project->finance_type }}</p>
              <p>Diajukan pada : {{ $project->created_at }}</p>
            </div>
          </div>
        </div>
      @endforeach
      @if(count($projects) == 0)
        <p >
          <span class="text-muted font-italic">Belum ada permintaan anda yang diterima, harap menunggu</span>
        </p>
      @endif
    </div>
  </div>
</section>

@if (count($completedProjects) > 0)
<section id="completed_projects" class="mt-4">
  <div class="card">
    <div class="card-header bg-red text-white">
      <div class="col-12 d-flex">
        <h1 class="title">Proyek Usai</h1>
      </div>
    </div>
    <div class="card-body">
      <hr class="bg-main">
      @foreach ($completedProjects as $completedProject)
          <div class="col-12 mt-3">
            <div class="card">
              <div class="card-body">
                <h3>Proyek dengan <a class="card-link" href="{{ route('consultant.profile.show', $completedProject->consultant->user->id) }}" target="_blank">{{ $completedProject->consultant->user->name }}</a></h3>
                <p>Jenis finansial : {{ $completedProject->finance_type }}</p>
                <p>Diajukan pada : {{ $completedProject->created_at }}</p>
                <form action="{{ route('consultant.consultant_rating.update', $completedProject->consultantRating->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="form-group">
                    <label for="completed-{{ $completedProject->id }}-rating">Rating :</label>
                    <input type="number" step="1" name="rating" readonly id="completed-{{ $completedProject->id }}-rating" value="{{ $completedProject->consultantRating->rating }}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="completed-{{ $completedProject->id }}-review">Review :</label>
                    <textarea name="review" readonly class="form-control" id="completed-{{ $completedProject->id }}-review">{{ $completedProject->consultantRating->review }}</textarea>
                  </div>
                  <a class="btn btn-warning" role="button" onclick="editReview({{ $completedProject->id }})" id="{{$completedProject->id}}-edit">Edit</a>
                  <input type="hidden" name="consultant_id" value="{{ $completedProject->consultant->id }}">
                  <input type="hidden" name="completed_project_id" value="{{ $completedProject->id }}">
                  <button class="btn btn-primary" type="submit" id="{{$completedProject->id}}-submit-edit" hidden>Submit</button>
                </form>
              </div>
            </div>
          </div>
      @endforeach
      @if(count($completedProjects) == 0)
        <p >
          <span class="text-muted font-italic">Belum ada permintaan anda yang diterima, harap menunggu</span>
        </p>
      @endif
    </div>
  </div>
</section>
@endif

@endsection

@section('footer')
  {{-- for editable form content --}}
  <script>
    let companyCount = $('.company').length;
    let isEditing = [];
    for (let index = 0; index < companyCount; index++) {
      isEditing.push(false);
    }

    function toggleEditCompany(id) {
      isEditing[id] = !isEditing[id];
      if(isEditing[id]) {
        $(`#company-${id} .readonlyinput`)
          .prop('contenteditable', true)
          .prop('readonly', false)
          .removeClass('border-0');
        $(`#edit-company-${id}`).hide();
        $(`#save-company-${id}`).prop('hidden', false);
      }
      else {
        $(`#company-${id} .readonlyinput`)
          .prop('readonly', true)
          .prop('contenteditable', false)
          .addClass('border-0');
        $(`#save-company-${id}`).hide();
        $(`#edit-company-${id}`).prop('hidden', true);
      }
    }

    function deleteCompany(event) {
      event.preventDefault();
      if(confirm(`You sure you want to delete this company?`)) {
        $(`#delete-company-${id}`).submit();
      }
    }

    function editReview(completedProjectId) {
      console.log(completedProjectId);
      $(`#completed-${completedProjectId}-rating`).prop('readonly', false);
      $(`#completed-${completedProjectId}-rating`).prop('contenteditable', true);
      $(`#completed-${completedProjectId}-review`).prop('readonly', false);
      $(`#completed-${completedProjectId}-review`).prop('contenteditable', true);
      $(`#${completedProjectId}-submit-edit`).prop('hidden', false);
      $(`#${completedProjectId}-edit`).prop('hidden', true);
    }
  </script>
@endsection
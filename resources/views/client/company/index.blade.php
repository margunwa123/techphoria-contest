@extends('client.layouts.index')

@section('page-title', 'Perusahaan anda')

@section('create-button')
<a href="{{ route('client.company.create') }}" class="btn btn-primary">Buat Perusahaan</a>
@endsection
    
@section('model-name', 'Perusahaan')

@section('page-items')
  @foreach ($companies as $company)
    <div class="col-12 company mb-3">
      <div data-toggle="collapse" href="#collapseExample{{ $loop->index }}" role="button" aria-expanded="false" aria-controls="collapseExample{{ $loop->index }}" class="card bg-main hoverable text-decoration-none">
        <div class="card-body text-white d-flex">
          <div class="">
            <h1>Perusahaan {{ $company->name }}</h1>
          </div>
          <div class="ml-auto d-flex align-items-center">
            <form action="{{ route('client.company.destroy', $company->id) }}" onsubmit="deleteCompany" method="POST" id="delete-company-{{ $company->id }}">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">
                <i class="fas fa-trash"></i>
              </button>
            </form>
          </div>
        </div>
      </div>
      <div class="collapse" id="collapseExample{{ $loop->index }}">
        <div class="card card-body">
          <form action="{{ route('client.company.update', $company->id) }}" method="POST" id="company-{{ $company->id }}">
            @csrf
            @method("PUT")
            <p>Bidang : <input class="readonlyinput border-0 form-control" readonly name="company_field" value="{{ $company->company_field }}" id="company_field"> <br>
              Telepon : <input class="readonlyinput border-0 form-control" readonly name="phone" value="{{ $company->phone }}" id="phone"> <br>
              Kota : <input class="readonlyinput border-0 form-control" readonly name="city" value="{{ $company->city }}" id="city"> <br>
              Didirikan pada : <input class="readonlyinput border-0 form-control" readonly name="found_date" value="{{ $company->found_date }}" id="found_date"> <br>
              Deskripsi : <textarea class="readonlyinput border-0 form-control" readonly name="description" id="description">{{ $company->description }}</textarea><br>
              Bidang Perusahaan : <input class="readonlyinput border-0 form-control" readonly name="company_field" value="{{ $company->company_field }}" id="company_field"> <br>
            </p>
            <div class="d-flex">
              <div id="edit-company-{{ $company->id }}">
                <a role="button" onclick="toggleEditCompany({{$company->id}})" id="edit-company-{{$company->id}}" class="btn btn-warning">Edit</a>
              </div>
              <div class="form-group" id="save-company-{{ $company->id }}" hidden>
                <button type="submit" class="btn btn-primary" >
                  Save
                </button>
              </div>
              <div class="ml-2">
                <a href="{{route('client.company.show', $company->id)}}" class="btn btn-primary">View</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    
  @endforeach
  @if (count($companies) == 0)
    <div class="text-center col-12">
      <span class="font-italic text-muted">Kamu belum membuat perusahaan, buat sekarang!</span>
    </div>
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
  </script>
@endsection
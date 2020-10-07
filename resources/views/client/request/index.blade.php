@extends('client.layouts.index')

@section('page-title', 'Permintaan Konsultasi Anda')

@section('page-subtitle')
<div class="d-flex col-12">
  <p class="text-muted font-italic">Bila anda telah meminta dan sudah tidak ada permintaan anda disini, maka kemungkinan permintaan anda sudah diterima</p>
  <a href="{{ route('client.project.index') }}" class="btn btn-secondary ml-auto">Proyek</a>
</div>
@endsection

@section('create-route', route('client.request.create'))
    
@section('model-name', 'Permintaan Konsultasi')

@section('page-items')
  @foreach ($companies as $company)
    <div class="col-12">
      <h2>Perusahaan {{ $company->name }}</h2>
    </div>
    @foreach ($company->requests as $request)
      <div class="col-md-12">
        <div class="card card-body bg-primary text-white hoverable " data-toggle="collapse" href="#request-{{ $request->id }}" role="button" aria-expanded="false" aria-controls="request-{{ $request->id }}">
          <div class="d-flex justify-content-between">
            <div class="">
              <h3>
                Konsultasi {{ $request->finance_type }}
              </h3>
            </div>
            <div class="">
              <form action="{{ route('client.request.destroy', $request->id) }}" onsubmit="deleteRequest" method="POST" id="delete-request-{{ $request->id }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
        <div class="collapse" id="request-{{ $request->id }}">
          <div class="card card-body">
            <form action="{{ route('client.request.update', $request->id) }}" method="POST" id="request-{{ $request->id }}">
              @csrf
              @method("PUT")
              <p>Jenis : <input class="readonlyinput border-0" readonly name="finance_type" value="{{ $request->finance_type }}" id="finance_type-{{$request->id}}"> <br>
                Deskripsi : <input class="readonlyinput border-0" readonly name="description" value="{{ $request->description }}" id="description-{{$request->id}}"> <br>
                Harga : <input class="readonlyinput border-0" readonly name="fee" value="{{ $request->fee }}" id="fee-{{$request->id}}"> <br>
                Criteria : <input class="readonlyinput border-0" readonly name="criteria" value="{{ $request->criteria }}" id="criteria-{{$request->id}}">
                <input type="hidden" name="company_id" value="{{ $company->id }}">
              </p>
              <div class="d-flex">
                <div id="edit-request-{{ $request->id }}">
                  <a role="button" onclick="toggleEdit({{$request->id}})" id="edit-request-{{$request->id}}" class="btn btn-warning">Edit</a>
                </div>
                <div class="form-group" id="save-request-{{ $request->id }}" hidden>
                  <button type="submit" class="btn btn-primary" >
                    Save
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    @endforeach
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

    function toggleEdit(id) {
      isEditing[id] = !isEditing[id];
      if(isEditing[id]) {
        $(`#request-${id} .readonlyinput`)
          .prop('contenteditable', true)
          .prop('readonly', false)
          .removeClass('border-0');
        $(`#edit-request-${id}`).hide();
        $(`#save-request-${id}`).prop('hidden', false);
      }
      else {
        $(`#request-${id} .readonlyinput`)
          .prop('readonly', true)
          .prop('contenteditable', false)
          .addClass('border-0');
        $(`#save-request-${id}`).hide();
        $(`#edit-request-${id}`).prop('hidden', true);
      }
    }

    function deleteRequest(event) {
      event.preventDefault();
      if(confirm(`You sure you want to delete this company?`)) {
        $(`#delete-request-${id}`).submit();
      }
    }
  </script>
@endsection
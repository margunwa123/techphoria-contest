@extends('client.layouts.index')

@section('page-title', 'Permintaan Konsultasi Personal Anda')

@section('page-subtitle')
<div class="d-flex col-12">
  <p class="text-muted font-italic">Bila anda telah meminta dan sudah tidak ada permintaan anda disini, maka kemungkinan permintaan anda sudah diterima</p>
  <a href="{{ route('client.project.index') }}" class="btn btn-secondary ml-auto">Proyek</a>
</div>
@endsection
@section('model-name', 'Permintaan Konsultasi')

@section('page-items')
  @foreach ($companies as $company)
    <div class="col-12">
      <h2>Perusahaan {{ $company->name }}</h2>
    </div>
    @foreach ($company->personalRequests as $personalRequest)
      <div class="col-md-12">
        <div class="card card-body bg-primary text-white hoverable " data-toggle="collapse" href="#request-{{ $personalRequest->id }}" role="button" aria-expanded="false" aria-controls="request-{{ $personalRequest->id }}">
          <div class="d-flex justify-content-between">
            <div class="">
              <h3>
                Konsultasi {{ $personalRequest->finance_type }}
              </h3>
              <span class="mr-2 font-italic">Kepada: Konsultan {{ $personalRequest->consultant->user->name }}</span>
            </div>
            <div class="">
              <form action="{{ route('client.personal_request.destroy', $personalRequest->id) }}" onsubmit="deleteRequest" method="POST" id="delete-request-{{ $personalRequest->id }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                  <i class="fas fa-trash"></i>
                </button>
              </form>
            </div>
          </div>
        </div>
        <div class="collapse" id="request-{{ $personalRequest->id }}">
          <div class="card card-body">
            @can('update', $personalRequest)
            <form action="{{ route('client.personal_request.update', $personalRequest->id) }}" method="POST" id="request-{{ $personalRequest->id }}">
              @csrf
              @method("PUT")
            @endcan

              <p>
                Kepada : <input class="border-0 form-control" readonly name="consultant_name" value="Konsultan {{ $personalRequest->consultant->user->name }}"><br>
                <input name="consultant_id" value="{{ $personalRequest->consultant->id }}" type="hidden">
                Jenis : <input class="readonlyinput border-0 form-control" readonly name="finance_type" value="{{ $personalRequest->finance_type }}" id="finance_type-{{$personalRequest->id}}"> <br>
                Deskripsi : <input class="readonlyinput border-0 form-control" readonly name="description" value="{{ $personalRequest->description }}" id="description-{{$personalRequest->id}}"> <br>
                Harga : <input class="readonlyinput border-0 form-control" readonly name="fee" value="{{ $personalRequest->fee }}" id="fee-{{$personalRequest->id}}"> <br>
                <input type="hidden" name="company_id" value="{{ $company->id }}">
              </p>
                @can('update', $personalRequest)
                <div class="d-flex">
                  <div id="edit-request-{{ $personalRequest->id }}">
                    <a role="button" onclick="toggleEdit({{$personalRequest->id}})" id="edit-request-{{$personalRequest->id}}" class="btn btn-warning">Edit</a>
                  </div>
                  <div class="form-group" id="save-request-{{ $personalRequest->id }}" hidden>
                    <button type="submit" class="btn btn-primary" >
                      Save
                    </button>
                  </div>
                </div>
                @endcan
              </div>
            @can('update', $personalRequest)
            </form>
            @endcan
            <form action="" id="consultant_accept" method="POST">
              @csrf
            </form>
            <form action="" id="consultant_reject" method="POST">
              @csrf
            </form>
          </div>
        </div>
      </div>
    @endforeach
    @if (count($company->personalRequests) == 0)
    <div class="col-12">
      <p class="text-muted font-italic">Perusahaan {{ $company->name }} belum memiliki permintaan jasa keuangan</p>
    </div>
    @endif
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
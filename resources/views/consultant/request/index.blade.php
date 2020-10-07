@extends('consultant.layouts.index')

@section('page-title', 'Permintaan Klien')
    
@section('page-subtitle')
<div class="col-12">
  <p class="text-muted font-italic">Lihat dan terima permintaan konsultasi dari klien</p>
</div>
@endsection

@section('page-items')
  <div class="col-12">
    <div class="collapse" id="data-toggle">
      <div class="card card-body">
        <h2>Detail permintaan nomor <span id="request_id"></span></h2>
        <ul class="list-group">
          <li class="list-group-item">Nama Perusahaan : <span id="company_name"></span></li>
          <li class="list-group-item">Tipe Jasa : <span id="finance_type"></span></li>
          <li class="list-group-item">Biaya : Rp.<span id="fee"></span></li>
          <li class="list-group-item">Deskripsi : <span id="description"></span></li>
          <li class="list-group-item">Kriteria Konsultan : <span id="criteria"></span></li>
        </ul>
        <div class="collapse mx-4" id="request-form">
          <div class="form-group row">
            <div class="col-12">
              <label for="title" class="col-form-label">Title <span class="text-red">*</span>: </label>
              <div>
                  <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="body" class="col-md-4 col-form-label">Mengapa anda tertarik? <span class="text-red">*</span>: </label>

            <div class="col-12">
                <textarea id="body" type="text" class="form-control" name="body" value="{{ old('body') }}" required>{{ old('body') }}</textarea>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
          <a id="accept-request" href="#request-form" data-toggle="collapse" class="btn btn-primary" id="open_form" onclick="toggleApplicationForm()">Buka Form</a>
          <a role="button" onclick="submitForm()" class="btn btn-success mx-2" id="apply_form" hidden >
            Apply <i class="fas fa-check"></i>
          </a>
          <a href="#data-toggle" data-toggle="collapse" class="btn btn-warning pl-3"  >Cancel <i class="fas fa-times"></i></a>
        </div>
      </div>
    </div>
    <table class="table table-bordered text-center">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama Perusahaan</th>
          <th scope="col">Tipe Jasa</th>
          <th scope="col">Biaya</th>
          <th scope="col">Detail</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($requests as $request)
          <tr>
            <th scope="row">{{ $loop->index + 1 }}</th>
            <td>{{ $request->company->name }}</td>
            <td>{{ $request->finance_type }}</td>
            <td>Rp. {{ $request->fee }}</td>
            <td>
              <a href="#data-toggle" data-toggle="collapse" onclick="supplyRequestInfo({{$request}}, {{$request->company}}, {{ $loop->index + 1 }})" role="button" class="btn btn-primary border-50">
                <i class="fas fa-search"></i>
              </a>
            </td>
            <form action="{{ route('consultant.apply_request.store', $request) }}" method="POST" id="submit-{{ $request->id }}">
              @csrf
              <input type="hidden" name="request_id" value="{{$request->id}}">
              <input type="hidden" id="title-{{ $request->id }}" name="title" value="">
              <input type="hidden" id="body-{{ $request->id }}" name="body" value="">
            </form>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection

@section('footer')
  <script>
    let formId = null;
    function supplyRequestInfo(request, company, index) {
      $('#company_name').html(company.name);
      $('#finance_type').html(request.finance_type);
      $('#description').html(request.description);
      $('#fee').html(request.fee);
      $('#criteria').html(request.criteria);
      $('#request_id').html(index);
      formId = request.id;
    }

    function submitForm() {
      $(`#title-${formId}`).prop('value', $('#title').prop('value'))
      $(`#body-${formId}`).prop('value', $('#body').prop('value'))
      $(`#submit-${formId}`).submit();
    }

    let applicationFormOpen = false;
    function toggleApplicationForm() {
      applicationFormOpen = !applicationFormOpen;
      if(applicationFormOpen) {
        $('#apply_form').prop('hidden', false)
      }
      else {
        $('#apply_form').prop('hidden', true)
      }
    }
  </script>
@endsection
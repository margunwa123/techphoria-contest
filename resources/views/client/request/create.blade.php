@extends('client.layouts.create')

@section('page-title', 'Buat Permintaan Konsultasi')

@section('index-route', route('client.request.index'))

@section('model-name', 'Permintaan')

@section('store-route', route('client.request.store'))

@section('form-items')
  <div class="form-group row">
      <label for="company_id" class="col-md-4 col-form-label text-md-right">Perusahaan<span class="text-red">*</span></label>

      <div class="col-md-6">
        <select id="company_id" type="text" class="form-control @error('company_id') is-invalid @enderror" name="company_id" required>
          @foreach ($companies as $company)
            <option value="{{$company->id}}">
              <div>{{$company->name}} - <span class="font-italic">{{ $company->company_field}}</span></div>
            </option>
          @endforeach
        </select>
      </div>
  </div>

  <div class="form-group row">
    <label for="finance_type" class="col-md-4 col-form-label text-md-right">Tipe Jasa Keuangan <span class="text-red">*</span></label>

    <div class="col-md-6">
      <input id="finance_type" type="text" class="form-control @error('finance_type') is-invalid @enderror" name="finance_type" value="{{ old('finance_type') }}" required autocomplete="finance_type" autofocus list="finance_type">
      <datalist>
        <option value="Perpajakan">Perpajakan</option>
        <option value="Rumah Tangga">Rumah Tangga</option>
        <option value="Saham">Saham</option>
      </datalist>
    </div>
    <div class="col-md-4">

    </div>
    <div class="col-md-6">
      <p class="small text-muted">
        Jasa keuangan seperti Perpajakan, Rumah Tangga, dan Saham
      </p>
    </div>
  </div>

  <div class="form-group row">
    <label for="description" class="col-md-4 col-form-label text-md-right">Deskripsi Tambahan <span class="text-red">*</span></label>

    <div class="col-md-6">
        <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required rows="3">{{ old('description') }}</textarea>
    </div>
  </div>

  <div class="form-group row">
    <label for="fee" class="col-md-4 col-form-label text-md-right">Budget <span class="text-red">*</span></label>

    <div class="col-md-6">
        <input id="fee" type="number" min="0" class="form-control @error('fee') is-invalid @enderror" name="fee" value="{{ old('fee') }}" required autocomplete="fee" autofocus>
    </div>
  </div>

  <div class="form-group row">
    <label for="criteria" class="col-md-4 col-form-label text-md-right">Kriteria Konsultan <span class="text-red">*</span></label>

    <div class="col-md-6">
        <textarea id="criteria" class="form-control @error('criteria') is-invalid @enderror" name="criteria" rows="3">{{ old('criteria') }}</textarea>
    </div>
  </div>

  <div class="form-group row mb-0">
      <div class="col-md-8 offset-md-4">
          <button type="submit" class="btn btn-primary">
              Buat Permintaan
          </button>
      </div>
  </div>
@endsection
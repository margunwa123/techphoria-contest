@extends('client.layouts.create')

@section('page-title', 'Buat Permintaan Konsultasi Pribadi')

@section('index-route', route('client.personal_request.index'))

@section('model-name', 'Konsultasi Pribadi')

@section('store-route', route('client.personal_request.store'))

@section('form-items')
  <div class="form-group row">
    <label for="consultant_name" class="col-md-4 col-form-label text-md-right">Konsultan</label>

    <div class="col-md-6">
      <input type="text" class="form-control" readonly value="{{ $consultant->user->name }}" name="consultant_name">
      <input type="hidden" value="{{ $consultant->id }}" name="consultant_id">
    </div>
  </div>
  <div class="form-group row">
    <label for="company_id" class="col-md-4 col-form-label text-md-right">Perusahaan</label>

    <div class="col-md-6">
      <select name="company_id" id="company_id" class="form-control">
        @foreach ($companies as $company)
          <option value="{{ $company->id }}">{{ $company->name }}</option>
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
  <label for="fee" class="col-md-4 col-form-label text-md-right">Budget (dalam rupiah) <span class="text-red">*</span></label>

  <div class="col-md-6">
      <input id="fee" type="number" min="0" class="form-control @error('fee') is-invalid @enderror" name="fee" value="{{ old('fee') }}" required autocomplete="fee" autofocus>
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
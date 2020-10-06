@extends('client.layouts.create')

@section('page-title', 'Buat Perusahaan')

@section('index-route', route('client.company.index'))

@section('model-name', 'Perusahaan')

@section('store-route', route('client.company.store'))

@section('form-items')
  <div class="form-group row">
      <label for="name" class="col-md-4 col-form-label text-md-right">Nama <span class="text-red">*</span></label>

      <div class="col-md-6">
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
      </div>
  </div>

  <div class="form-group row">
    <label for="company_field" class="col-md-4 col-form-label text-md-right">Bidang Perusahaan <span class="text-red">*</span></label>

    <div class="col-md-6">
        <input id="company_field" type="text" class="form-control @error('company_field') is-invalid @enderror" name="company_field" value="{{ old('company_field') }}" required autocomplete="company_field" autofocus>
    </div>
  </div>

  <div class="form-group row">
    <label for="city" class="col-md-4 col-form-label text-md-right">Kota <span class="text-red">*</span></label>

    <div class="col-md-6">
        <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ old('city') }}" required autocomplete="city" autofocus>
    </div>
  </div>

  <div class="form-group row">
    <label for="found_date" class="col-md-4 col-form-label text-md-right">Berdiri Sejak <span class="text-red">*</span></label>

    <div class="col-md-6">
        <input id="found_date" type="date" class="form-control @error('found_date') is-invalid @enderror" name="found_date" value="{{ old('found_date') }}" required autocomplete="found_date" autofocus>
    </div>
  </div>

  <div class="form-group row">
    <label for="phone" class="col-md-4 col-form-label text-md-right">Nomor Telepon <span class="text-red">*</span></label>

    <div class="col-md-6">
        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
    </div>
  </div>

  <div class="form-group row">
    <label for="description" class="col-md-4 col-form-label text-md-right">Deskripsi <span class="text-red">*</span></label>

    <div class="col-md-6">
        <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" required autofocus>{{ old('description') }}</textarea>
    </div>
  </div>

  <div class="form-group row mb-0">
      <div class="col-md-8 offset-md-4">
          <button type="submit" class="btn btn-primary">
              {{ __('Buat Perusahaan') }}
          </button>
      </div>
  </div>
@endsection
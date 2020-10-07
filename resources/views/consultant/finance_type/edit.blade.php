@extends('consultant.layouts.edit')

@section('page-title', 'Ubah tipe konsultan anda')

@section('index-route', route('consultant.home'))

@section('update-route', route('consultant.finance_type.update'))

@section('form-items') 
  <div class="card-header text-sm-2 text-white bg-primary">
    Spesialisasi anda
  </div>
  <div class="card-body">
    <div class="form-group row">
      <div class="col-md-4">
        <label for="finance_type">Apa spesialisasi jasa keuangan anda? (tuliskan sebanyak banyaknya) <span class="text-red">*</span></label>
      </div>
      <div class="col-md-6">
        <input type="text" name="finance_type" id="finance_type" class="form-control" value="{{ $consultant->finance_type }}">
      </div>
      <div class="col-md-4">

      </div>
      <div class="col-md-6">
        <p class="font-italic text-muted">
          Contoh : Perpajakan, saham, rumah tangga
        </p>
      </div>
    </div>
  </div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <h1 class="title">Selamat datang Konsultan {{ $user->name }}!</h1>
      <hr class="bg-orange">
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <h3>Apply ke sebuah permintaan konsultasi</h3>
    </div>
    <div class="col-12">
      <ol class="text-sm-2 list-spacing">
        <li>Cari permintaan klien anda di halaman <a target="_blank" href="{{route('consultant.request.index')}}">request</a></li>
        <li>Apply ke sebuah permintaan klien, berikan judul dan alasan yang bermakna</li>
        <li>Bila anda telah diterima, di halaman <b>project</b> akan muncul proyek baru dan apply request anda dihapus</li>
        <li>Bila anda tidak diterima, di halaman <b>project</b> tidak akan muncul proyek baru dan apply request anda dihapus</li>
        <li>Lanjut ke <a href="#working-project"> mengerjakan proyek</a></li>
      </ol>
    </div>
    <div class="col-12">
      <h3>Permintaan personal dari klien</h3>
    </div>
    <div class="col-12">
      <ol class="text-sm-2 list-spacing">
        <li>Klien bisa meminta secara personal di halaman <a target="_blank" href="{{route('consultant.personal_request.index')}}">permintaan personal</a></li>
        <li>Bila anda menerima permintaan, akan otomatis menjadi proyek, bila tidak akan langsung dihapuskan dari daftar permintaan</li>
        <li>Lanjut ke <a href="#working-project"> mengerjakan proyek</a></li>
      </ol>
    </div>
    <div class="col-12" id="working-project">
      <h3>Mengerjakan proyek</h3>
      <ol class="text-sm-2 list-spacing">
        <li>Langsung ke halaman proyek
          <a href="{{ route('consultant.project.index') }}" class="btn btn-warning"><i class="fas fa-hard-hat"></i> Proyek</a>
          dan cek nomor HP perusahaan, untuk mulai berkomunikasi (website kami belum menyediakan jasa <span class="font-italic">chatting</span>)
        </li>
        <li>
          Nanti bila proyek telah selesai, anda akan diberikan rating dan penghargaan. Setiap rating akan berpengaruh terhadap reputasi dan muncul di profil anda (<a target="_blank" href="{{route('consultant.profile.show', $user->id)}}">profil</a>) 
        </li>
      </ol>
    </div>
  </div>
</div>
@endsection
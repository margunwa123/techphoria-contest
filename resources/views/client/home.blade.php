@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-12">
      <h1 class="title">Selamat datang {{ $user->name }}!</h1>
      <hr class="bg-orange">
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <h3>Ikuti langkah langkah dibawah ini untuk meminta jasa konsultasi anda</h3>
    </div>
    <div class="col-12">
      <ol class="text-sm-2 list-spacing">
        <li>Buat dan isi profil perusahaan anda <a target="_blank" href="{{route('client.company.create')}}">disini</a></li>
        <li>Buat permintaan jasa <span class="text-red font-italic">atau</span> Lihat konsultan untuk meminta pertolongan personal</li>
        <li>Bila permintaan ada yang menerima, di halaman <b>request</b> bagian permintaan terkait akan muncul siapa saja yang ingin membantu anda, klik pada konsultan yang ingin membantu dan terima atau tolak permintaannya</li>
        <li>Bila permintaan personal, apabila permintaan anda sudah tidak ada di daftar, berarti konsultan sudah menerima atau menolak (check di halaman <a target="_blank" href="{{ route('client.project.index') }}">proyek</a>), bila diterima lanjut ke <a href="#consultant-accepted"> Konsultan telah menerima</a></li>
        <li>Bila permintaan anda masih ada, berarti belum ada yang menerima</li>
        <li>Bila permintaan personal anda ditolak (tidak ada di halaman personal request ataupun di project), anda harus membuat permintaan baru</li>
      </ol>
    </div>
    <div class="col-12" id="consultant-accepted">
      <h3>Bila permintaan telah diterima</h3>
      <ol class="text-sm-2 list-spacing">
        <li>Langsung ke halaman proyek
          <a href="{{ route('client.project.index') }}" class="btn btn-warning"><i class="fas fa-hard-hat"></i> Proyek</a>
          dan cek nomor HP konsultan, untuk mulai berkomunikasi (website kami belum menyediakan jasa <span class="font-italic">chatting</span>)
        </li>
        <li>
          Nanti bila proyek telah selesai, berikan rating kepada konsultan di halaman 
          <a href="{{ route('client.project.index') }}" class="btn btn-warning"><i class="fas fa-hard-hat"></i> Proyek</a> 
          bagian 
          <b>proyek yang usai</b> 
        </li>
      </ol>
    </div>
  </div>
</div>
@endsection
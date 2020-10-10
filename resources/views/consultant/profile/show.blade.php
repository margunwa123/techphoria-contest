@extends('consultant.layouts.show')

@section('page-title')
<div class="">
    <i class="fas fa-user text-main mr-1"></i>
    Halaman Profile Consultant
</div>
@endsection

@section('page-subtitle')
@if (Auth::user()->role == "client")
  <div class="ml-auto d-flex align-items-center">
    <form action="{{ route('client.personal_request.create') }}">
      <input type="hidden" name="consultant" value="{{ $user->consultant->id }}">
      <button type="submit" class="btn btn-primary">Minta konsultasi</button>
    </form>
  </div>
@endif
@endsection

@section('page-content')
  <form action="{{ route('consultant.profile.update', $user->id) }}" id="user-form" method="post">
    @csrf
    @method('PUT')
    <div class="client-profile-container">
      <div class="left-content-container">
        <div class="image-container">
          <img src="/asset/vinaid-logo.png" alt="">
        </div>
        @can('update', $user)
          <div class="btn btn-warning edit-profile" id="edit-profile" onclick="toggleEditUser()"> Edit Profile </div>
          <button type="submit" class="btn btn-primary" id="save-profile" hidden>
            Save Profile
          </button>
        @endcan
      </div>
      <div class="right-content-container">
        <div class="username-job-container">
        <div class="username-section"><span>{{ $user->username }}</span></div>
          <div class="job-section">
            <input style="font-weight: bold" class="readonlyinput border-0" readonly name="job" value="{{ $user->job }}" id="job">
            <span><i class="fas fa-star text-yellow"></i> Rating : {{ $user->consultant->rating }} / 5</span>
          </div>
        </div>
        <div class="form-item" id="name-field">
          <span class="label">Nama Lengkap</span>
          <span>:  <input style="font-weight: bold" class="readonlyinput border-0" readonly name="name" value="{{ $user->name }}" id="name"></span>
        </div>
        <div class="form-item" id="phone-field">
          <span class="label">Nomor Telepon</span>
          <span>:  <input style="font-weight: bold" class="readonlyinput border-0" readonly name="phone" value="{{ $user->phone }}" id="phone"></span>
        </div>
        <div class="form-item" id="email-field">
          <span class="label">Email</span>
          <span>:  <input style="font-weight: bold" class="readonlyinput border-0" readonly name="email" value="{{ $user->email }}" id="email"></span>
        </div>
        <div class="form-item" id="gender-field">
          <span class="label">Gender</span>
          <span>:  <input style="font-weight: bold" class="border-0" readonly name="gender" value="{{ $user->gender == 'male' ? 'Laki-Laki' : 'Perempuan' }}" id="gender"></span>
        </div>
        <div class="form-item" id="gender-field">
          <span class="label">Role</span>
          <span>:  <input style="font-weight: bold" class="border-0" readonly name="role" value="{{ $user->role == 'client' ? 'Klien' : 'Konsultan' }}" id="role"></span>
        </div>
      </div>
    </div>
  </form>

  <h1 class="mt-3">
    <i class="fas fa-scroll text-red"></i>
    Review Klien
  </h1>
  <p class="text-muted font-italic">
      Klien hanya dapat mereview apabila telah menjalankan proyek bersama konsultan
  </p>
  @foreach ($reviews as $review)
    <div class="card mt-3 mb-1">
      <div class="card-header d-flex text-white bg-primary">
        Perusahaan {{ $review->completedProject->company->name }}
        <div class="ml-auto font-italic">
          Pada : {{ $review->created_at }}
        </div>
      </div>
      <div class="card-body">
        <p>
          Rating : {{ $review->rating }}<i class="fas fa-star text-yellow"></i>
        </p>
        <p>
          Comment : {{ $review->review }}
        </p>
      </div>
    </div>
  @endforeach
  @if (count($reviews) == 0) 
    <p class="text-muted font-italic">Belum ada review...</p>
  @endif
@endsection

@section('footer')
<script>
  let isEditing = false;
  function toggleEditUser() {
    isEditing = !isEditing;
    if(isEditing) {
      $(`#user-form .readonlyinput`)
        .prop(`contenteditable`, true)
        .prop(`readonly`, false)
        .removeClass('border-0');
      $(`#edit-profile`).hide();
      $(`#save-profile`).prop('hidden', false);
    } else {
      $(`#user-form .readonlyinput`)
        .prop(`contenteditable`, false)
        .prop(`readonly`, true)
        .addClass('border-0');
      $(`#edit-profile`).prop('hidden', false);
      $(`#save-profile`).hide();
    }
  }
</script>
@endsection
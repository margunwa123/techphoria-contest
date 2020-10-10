@extends('consultant.layouts.show')

@section('page-title')
  <i class="fas fa-user text-main"></i>
  Halaman Profile Consultant
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
        <div class="btn btn-warning edit-profile" id="edit-profile" onclick="toggleEditUser()"> Edit Profile </div>
        <button type="submit" class="btn btn-primary" id="save-profile" hidden>
          Save Profile
        </button>
      </div>
      <div class="right-content-container">
        <div class="username-job-container">
        <div class="username-section"><span>{{ $user->username }}</span></div>
          <div class="job-section">
            <input style="font-weight: bold" class="readonlyinput border-0" readonly name="name_field" value="{{ $user->job }}" id="job">
            <span>Rating : {{ $user->rating != '' ? $user->rating : 0  }} / 5</span>
          </div>
        </div>
        <div class="form-item" id="name-field">
          <span class="label">Nama Lengkap</span>
          <span>:  <input style="font-weight: bold" class="readonlyinput border-0" readonly name="name_field" value="{{ $user->name }}" id="name"></span>
        </div>
        <div class="form-item" id="phone-field">
          <span class="label">Nomor Telepon</span>
          <span>:  <input style="font-weight: bold" class="readonlyinput border-0" readonly name="phone_field" value="{{ $user->phone }}" id="phone"></span>
        </div>
        <div class="form-item" id="email-field">
          <span class="label">Email</span>
          <span>:  <input style="font-weight: bold" class="readonlyinput border-0" readonly name="email_field" value="{{ $user->email }}" id="email"></span>
        </div>
        <div class="form-item" id="gender-field">
          <span class="label">Gender</span>
          <span>:  <input style="font-weight: bold" class="border-0" readonly name="name_field" value="{{ $user->gender == 'male' ? 'Laki-Laki' : 'Perempuan' }}" id="gender"></span>
        </div>
        <div class="form-item" id="gender-field">
          <span class="label">Role</span>
          <span>:  <input style="font-weight: bold" class="border-0" readonly name="name_field" value="{{ $user->role == 'client' ? 'Klien' : 'Konsultan' }}" id="role"></span>
        </div>
      </div>
    </div>
  </form>
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
@extends('client.layouts.show')

@section('page-title')
  <i class="fas fa-user text-main"></i>
  Halaman Profile Client
@endsection

@section('page-content')
  <form action="{{ route('client.profile.update', $user->id) }}" id="user-form" method="post">
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
          <div class="username-section">{{ $user->username }}</div>
          <div class="job-section">
            <input style="font-weight: bold" class="readonlyinput border-0" readonly name="job" value="{{ $user->job }}" id="job">
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
          <span>:  <input style="font-weight: bold" class="border-0" readonly name="gender" value="{{ $user->gender}}" id="gender"></span>
        </div>
        <div class="form-item" id="gender-field">
          <span class="label">Role</span>
          <span>:  <input style="font-weight: bold" class="border-0" readonly name="role" value="{{ $user->role}}" id="role"></span>
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
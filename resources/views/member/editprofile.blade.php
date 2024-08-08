@extends('components.layouts.member.navback')

@section('title, nemolab')

@section('back', 'Back')

@section('content-editprofile')
<link rel="stylesheet" href="{{ asset('nemolab/assets/css/editprofile.css') }}">
<div class="container">
  <div class="row">
    <div class="col-12 d-flex justify-content-center">
      <div class="box bg-white rounded-4">
        <h4 class="fw-semibold" style="color: #faa907; margin-bottom: 2rem">Edit Profile</h4>
        <form action="">
          <div class="input text-center">
            <img src="{{ asset('nemolab/assets/image/profile2.png') }}" alt="" class="rounded-circle" width="90" />
          </div>
          <div class="input mt-5 mb-2">
            <input type="file" id="avatar" class="custom-file-input fw-medium" style="color: rgba(0, 0, 0, 0.546);"/><br />
            <label for="avatar">Format file jpg, jpeg, png.</label>
          </div>
          <div class="input">
            <label for="name">Full Name</label><br />
            <input type="text" id="name" class="profile" />
          </div>
          <div class="input my-3">
            <label for="email">Email Address</label><br />
            <input type="text" id="email" class="profile"  />
          </div>
          <div class="input">
            <label for="username">Username</label><br />
            <input type="text" id="username" class="profile"  />
          </div>
          <div class="input mt-4">
            <input type="submit" value="Save My Profile" class="profile button py-2 text-white fw-semibold rounded-5" style="font-size: 14px" />
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

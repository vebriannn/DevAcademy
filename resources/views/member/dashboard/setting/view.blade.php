@extends('components.layouts.member.app')

@section('content')
<link rel="stylesheet" href="{{ asset('nemolab/member/css/dashboard-setting.css') }}">
<link rel="stylesheet" href="{{ asset('nemolab/components/member/css/sidebar.css') }}">
<div class="container">
    <div class="row">
      <!-- My Profil -->
      <div class="col-lg-5 col-md-10 col-12 mx-auto mx-lg-0 px-5 ms-lg-3">
        <h3 class="fw-semibold mb-4" style="color: #faa907">My Profile</h3>
        <form action="">
          <div class="input">
            <label for="">My Avatar</label><br />
            <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}" alt="" width="90" />
          </div>
          <div class="input">
            <label for="name">Full Name</label><br />
            <input type="text" id="name" value="{{ Auth::user()->name }}" readonly/>
          </div>
          <div class="input">
            <label for="email">Email Address</label><br />
            <input type="email" id="email"  value="{{ Auth::user()->email }}" readonly/>
          </div>
          <div class="input">
            <label for="username">Username</label><br />
            <input type="text" id="username"  value="{{ Auth::user()->username }}" readonly />
          </div>
          <div class="input d-flex gap-2">
            <div class="input-password w-50">
              <label for="password">Password</label><br />
              <input type="password" id="password"  value="{{ Auth::user()->password }}" readonly/>
            </div>
            <div class="btn-password w-50" style="padding-top: 35px">
              <a href="{{ route('member.dashboard.edit-password') }}" class="edit-pass">Edit Password</a>
            </div>
          </div>
          <div class="input mt-4">  
            <a href="{{ route('member.dashboard.edit-profile') }}" class="edit-pass">Edit My Profile</a>
          </div>
        </form>
      </div>
    </div>
</div>
@endsection

@extends('components.layouts.member.dashboard')

@section('content-setting')
<link rel="stylesheet" href="{{ asset('nemolab/assets/css/dashboardsettings.css') }}">
<link rel="stylesheet" href="{{ asset('nemolab/assets/css/components/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('nemolab/assets/css/dashboardsettings.css') }}">
<div class="container">
    <div class="row">
            <!-- Sidebar -->
            <div class="col-3 d-none d-lg-block p-4 rounded-4 text-white" style="background-color: #faa907">
              <img src="{{ asset('nemolab/assets/image/profile2.png') }}" alt="" width="70"
                  class="d-flex mx-lg-auto mt-3" />
              <h4 class="m-0 mt-lg-5 mt-3 fw-semibold">Kenzo Ardiano</h4>
              <p class="m-0 fw-light">Status Member</p>
              <div class="mt-5">
                  <a href="#" class="list-sidebar">
                      <img src="{{ asset('nemolab/assets/image/course.png') }}" alt="" width="30" />
                      <p class="m-0">My Courses</p>
                  </a>
                  <a href="#" class="list-sidebar">
                      <img src="{{ asset('nemolab/assets/image/portofolio.png') }}" alt="" width="30" />
                      <p class="m-0">My Portofolio</p>
                  </a>
                  <a href="dashboard-transactions.html" class="list-sidebar">
                      <img src="{{ asset('nemolab/assets/image/transaksi.png') }}" alt="" width="30" />
                      <p class="m-0">Transactions</p>
                  </a>
                  <a href="#" class="list sidebar active">
                      <img src="{{ asset('nemolab/assets/image/setting active.png') }}" alt="" width="30"/>
                      <p class="m-0 fw-semibold">Settings</p>
                  </a>
              </div>
          </div>
          <!-- End Sidebar -->
      <!-- My Profil -->
      <div class="col-lg-5 col-md-10 col-12 mx-auto mx-lg-0 px-5 ms-lg-3">
        <h3 class="fw-semibold mb-4" style="color: #faa907">My Profile</h3>
        <form action="">
          <div class="input">
            <label for="">My Avatar</label><br />
            <img src="{{asset('nemolab/assets/image/profile2.png')}}" alt="" width="90" />
          </div>
          <div class="input">
            <label for="name">Full Name</label><br />
            <input type="text" id="name"  />
          </div>
          <div class="input">
            <label for="email">Email Address</label><br />
            <input type="email" id="email" />
          </div>
          <div class="input">
            <label for="username">Username</label><br />
            <input type="text" id="username"  />
          </div>
          <div class="input d-flex gap-2">
            <div class="input-password w-50">
              <label for="password">Password</label><br />
              <input type="password" id="password" />
            </div>
            <div class="btn-password w-50" style="padding-top: 33px">
              <input type="submit" value="Edit Password" />
            </div>
          </div>
          <div class="input mt-4">
            <input type="submit" value="Edit My Profile" class="inp button py-2 text-white fw-semibold rounded-5" style="font-size: 14px" />
          </div>
        </form>
      </div>
    </div>
</div>
@endsection
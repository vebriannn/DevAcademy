<div class="container" style="margin-bottom: 7rem">
  <nav class="navbar fixed-top bg-white px-5">
    <div class="container-fluid py-2">
      <div class="d-flex align-items-center gap-4">
        <img src="{{asset('nemolab/assets/image/LogoNemolabClear.png')}}" alt="Logo" width="40" />
        <div>
          <a href="#" class="text-decoration-none d-flex align-items-center gap-2" style="color: #faa907">
            <i class="bi bi-chevron-left fs-4"></i>
            <p class="m-0 fw-bold">@yield('back')</p>
          </a>
        </div>
      </div>
      
      <div class="user-login d-flex align-items-center gap-3">
        <img src="{{ asset('nemolab/assets/image/avatar.png') }}" alt="" width="40" class="d-md-block d-lg-none border border-2 rounded-circle" />
        <p class="fw-semibold m-0">Halo, User</p>
        <img src="{{ asset('nemolab/assets/image/avatar.png') }}" alt="" width="45" class="d-none d-lg-block border border-2 rounded-circle" id="myProfile" style="cursor: pointer" />

        <!-- Profile Menu -->
        <div class="profile-user border border-2 rounded-2" id="profileMenu">
          <a href="" class="bg-white px-3 py-2 d-flex align-items-center text-decoration-none text-black-50">
            <img src="{{ asset('nemolab/assets/image/profile copy.png') }}" alt="" width="23" />
            <div class="item fw-semibold m-0 w-100">Dashboard</div>
            <div class="ms-4 fw-semibold">></div>
          </a>
          <a href="{{ route('logout') }}" type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="bg-white px-3 py-2 d-flex align-items-center text-decoration-none text-black-50">
            <img src="{{ asset('nemolab/assets/image/logout.png') }}" alt="" width="23" />
            <div class="item fw-semibold m-0 w-100">Logout</div>
            <div class="fw-semibold">></div>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        </div>
      </div>
    </div>
  </nav>
</div>
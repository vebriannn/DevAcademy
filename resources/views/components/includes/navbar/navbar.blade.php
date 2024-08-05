<div class="container" style="margin-bottom: 7rem">
    <nav class="navbar navbar-expand-lg fixed-top bg-white px-5">
      <div class="container-fluid py-2">
        <a class="navbar-brand" href="#">
          <img src="{{ asset('nemolab/assets/image/LogoNemolab.png') }}" alt="Logo" width="110" class="d-inline-block align-text-top" />
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto gap-3">
            <li class="nav-item pt-lg-0 pt-sm-4 pt-4">
              <a class="nav-link" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('course') }}">Course</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="">Contact Us</a>
            </li>

            <!-- Mentor -->
            <li class="nav-item d-lg-none d-md-block">
              <a class="nav-link" href="">Mentor</a>
            </li>

            <!-- Dashboard -->
            <li class="nav-item dropdown d-lg-none">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Dashboard </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">My Courses</a></li>
                <li><a class="dropdown-item" href="#">My Portofolio</a></li>
                <li><a class="dropdown-item" href="#">Transactions</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
              </ul>
            </li>

            <!-- Superadmin -->
            <li class="nav-item dropdown d-lg-none">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> View Data </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Data Member</a></li>
                <li><a class="dropdown-item" href="#">Data Mentor</a></li>
                <li><a class="dropdown-item" href="#">Data Super Admin</a></li>
                <li><a class="dropdown-item" href="#">Pengajuan Mentor</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown d-lg-none">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Learn </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Courses</a></li>
                <li><a class="dropdown-item" href="#">Lesson</a></li>
                <li><a class="dropdown-item" href="#">Chapter</a></li>
              </ul>
            </li>

            <li class="nav-item dropdown d-lg-none">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Category </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Category</a></li>
              </ul>
            </li>
          </ul>
          <hr />

          @if (Auth::check())
          {{-- Login Username --}}
          <div class="user-login d-flex align-items-center gap-3">
            <img src="{{ asset('nemolab/assets/image/avatar.png') }}" alt="" width="40" class="d-md-block d-lg-none border border-2 rounded-circle" />
            <p class="fw-semibold m-0">Halo, User</p>
            <img src="{{ asset('nemolab/assets/image/avatar.png') }}" alt="" width="45" class="d-none d-lg-block border border-2 rounded-circle" id="myProfile" style="cursor: pointer" />

            <!-- Profile Menu -->
            <div class="profile-user border border-2 rounded-2 overflow-hidden" id="profileMenu">
              <a href="" class="bg-white px-3 py-2 d-flex align-items-center text-decoration-none text-black-50">
                <img src="{{ asset('nemolab/assets/image/profile copy.png') }}"  alt="" width="23" />
                <div class="item fw-semibold m-0 w-100">Dashboard</div>
                <div class="ms-4 fw-semibold">></div>
              </a>
              <a href="{{ route('logout') }}" type="button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="bg-white px-3 py-2 d-flex align-items-center text-decoration-none text-black-50">
                <img src="{{ asset('nemolab/assets/image/logout.png') }}"  alt="" width="23" />
                <div class="item fw-semibold m-0 w-100">Logout</div>
                <div class="fw-semibold">></div>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </div>
          </div>
          @else
              <a type="button" class="btn btn-login me-lg-2 me-md-0" href="{{ route('login') }}">Log In</a>
              <a type="button" class="btn btn-signup text-white mt-lg-0 mt-md-2" href="{{ route('register') }}">Sign Up</a>
          @endif
        </div>
      </div>
    </nav>
  </div>
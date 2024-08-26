<!-- NAVBAR -->
<div class="container">
    <nav class="navbar navbar-expand-lg fixed-top bg-white px-5 z-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('nemolab/admin/img/Logo Nemolab.png') }}" alt="Logo" width="100"
                    class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item pt-lg-0 pt-sm-4">
                        <a class="nav-link" href="{{ route('home') }}#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('member.course') }}">Course</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#aboutus">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#contactus">Contact Us</a>
                    </li>
                </ul>
                <hr />
                <div class="user-login d-flex align-items-center gap-3">
                    <p class="fw-semibold m-0 order-last order-lg-first">{{ Auth::user()->name }}</p>
                    @if (Auth::user()->avatar != 'default.png')
                        <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}" alt=""
                            width="45" height="45" class="border border-2 rounded-circle" id="myProfile"
                            style="cursor: pointer" />
                    @else
                        <img src="{{ asset('nemolab/admin/img/avatar.png') }}" alt="" width="45" height="45"
                            class="d-none d-lg-block border border-2 rounded-circle" id="myProfile"
                            style="cursor: pointer" />
                    @endif
                    <!-- Profile Menu -->
                    <div class="profile-user border border-2 rounded-2 overflow-hidden" id="profileMenu">
                        <a href="{{ route('member.dashboard') }}"
                            class="bg-white px-3 py-2 d-flex align-items-center text-decoration-none text-black-50 item fw-semibold m-0 w-100 fw-bold">
                            Dashboard
                        </a>
                        <a href="{{ route('member.setting') }}"
                            class="bg-white px-3 py-2 d-flex align-items-center text-decoration-none text-black-50 item fw-semibold m-0 w-100 fw-bold">
                            Setting
                        </a>
                        <a href="{{ route('member.logout') }}"
                            class="bg-white px-3 py-2 d-flex align-items-center text-decoration-none text-black-50 item fw-semibold m-0 w-100 fw-bold">
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>

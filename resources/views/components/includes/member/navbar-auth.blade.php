<!-- NAVBAR -->
<div class="container">
    <nav class="navbar navbar-expand-lg fixed-top bg-white px-5 z-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('nemolab/assets/image/LogoNemolab.png') }}" alt="Logo" width="30" height="24"
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
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('member.course') }}">Course</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#aboutus">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#contactus">Contact Us</a>
                    </li>
                </ul>
                <hr />
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}" alt=""
                        width="40" class="d-md-block d-lg-none" />
                    <p class="fw-semibold m-0">Halo, {{ Auth::user()->name }}</p>
                    <img src="{{ asset('nemolab/assets/image/avatar.png') }}" alt="" width="40"
                        class="d-none d-lg-block" />
                </div>
            </div>
        </div>
    </nav>
</div>


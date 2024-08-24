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
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#course">Course</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#aboutus">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}#contactus">Contact Us</a>
                    </li>
                </ul>
                <hr />
                <div class="r-nav align-items-center ">
                    <a type="button" class="btn btn-login me-lg-2 me-md-0" href="{{ route('member.login') }}">Log In</a>
                    <a type="button" class="btn btn-signup text-white mt-lg-0 mt-md-2"
                        href="{{ route('member.register') }}">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>
</div>

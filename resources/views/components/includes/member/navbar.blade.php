    <!-- NAVBAR -->
    <div class="container">
        <nav class="navbar navbar-expand-lg ">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('nemolab/assets/image/LogoNemolab.png') }}" alt="Logo" width="30"
                        height="24" class="d-inline-block align-text-top">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item pt-lg-0 pt-sm-4">
                            <a class="nav-link active" aria-current="page" href="{{ route('home') }}#home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('/course') ? 'active' : '' }}" href="{{ route('home') }}#course">Course</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}#aboutus">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}#contactus">Contact Us</a>
                        </li>
                    </ul>
                    <div class="r-nav align-items-center ">
                        <a type="button" class="btn btn-login me-lg-2 me-md-0" href="{{ route('login') }}">Log In</a>
                        <a type="button" class="btn btn-signup text-white mt-lg-0 mt-md-2"
                            href="{{ route('register') }}">Sign Up</a>
                    </div>
                </div>
            </div>
    </div>
    </nav>

    </div>
    <!-- SEARCH MODAL -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchModalLabel">Search</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="searchInput" class="form-label">Search</label>
                            <input type="text" class="form-control" id="searchInput" placeholder="Enter your search">
                        </div>
                        <button type="submit" class="btn-search px-2 py-1">Search</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

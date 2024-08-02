<div class="container">
  <nav class="navbar navbar-expand-lg">
      <div class="container-fluid">
          <a class="navbar-brand" href="#">
              <img src="{{ asset('nemolab/assets/image/LogoNemolab.png') }}" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
                  <li class="nav-item pt-lg-0 pt-sm-4">
                      <a class="nav-link active" aria-current="page" href="/">Home</a>
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
              </ul>
              <hr class="d-none d-sm-block">
              @if (Auth::check())
                  <a type="button" class="btn btn-logout me-lg-2 me-md-0" href="{{ route('logout') }}"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      Log Out
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
              @else
                  <a type="button" class="btn btn-login me-lg-2 me-md-0" href="{{ route('login') }}">Log In</a>
                  <a type="button" class="btn btn-signup text-white mt-lg-0 mt-md-2" href="{{ route('register') }}">Sign Up</a>
              @endif
          </div>
      </div>
  </nav>
</div>

@extends('components.layouts.member.login&register')

@section('title', 'Nemolab')

@section('content-login')
<div class="container">
    <div class="row">
      <div class="col-12 d-flex justify-content-center">
        <div class="box rounded-5 bg-white text-center d-flex flex-column justify-content-center shadow-lg">
          <div>
            <img src="{{ asset('nemolab/assets/image/logo.png') }}" alt="logo" width="130" />
          </div>
          <h3 class="fw-bold">Login To <span>Nemolab</span></h3>
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-col position-relative">
              <input type="email" name="email" placeholder="Email address" value="{{ old('email') }}" />
              <span class="ikon"><img src="{{ asset('nemolab/assets/image/emaillogin.png') }}" width="16" /></span>
              @error('email')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="input-col position-relative mt-2">
              <input type="password" name="password" placeholder="Password" id="password" />
              <span class="ikon"><img src="{{ asset('nemolab/assets/image/password.png') }}" width="16" /></span>
              <span class="eye">
                <img src="{{ asset('nemolab/assets/image/eye.png') }}" width="20" class="pass-icon opacity-25" id="pass-icon" onclick="pass()" />
              </span>
              @error('password')
                <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="d-grid gap-2 mt-3">
              <button type="submit" class="btn text-white fw-semibold">Continue</button>
              <a href="{{ route('register') }}" class="btn text-white fw-semibold">Create New Account</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

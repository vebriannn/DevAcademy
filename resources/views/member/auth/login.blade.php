@extends('components.layouts.member.auth')

@section('title', 'Masuk dengan akunmu untuk mengakses kelas')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('devacademy/member/css/auth.css') }} ">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6 p-0 image-container">
                <img src="{{ asset('devacademy/member/img/bismen.png') }}" style="height: 100vh" alt="Team collaboration" class="img-fluid rounded-start">
        </div>
        <div class="col-sm-12 col-md-6 p-0">
            <div class="card-body px-5 py-2">
                <a href="{{ route('home') }}" class="btn-back mb-4">
                    <img src="{{ asset('devacademy/member/img/icon/arrow.png') }}" alt="Back" class="back-icon">
                </a>
                <div class="px-3 text-center">
                    <h3 class="mb-4" data-aos="fade-left" data-aos-delay="100">MASUK DENGAN AKUNMU!</h3>
                    <p class="fw-bold" data-aos="fade-left" data-aos-delay="200">Masuk untuk mengakses akun anda, dengan mengisi email dan password dibawah ini</p>
                </div>
                <form id="loginForm" method="POST" action="{{ route('member.login.auth') }}" class="signin-form">
                    @csrf
                    <div class="mb-1" >
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" name="email" placeholder="Masukan email anda"  value="{{ old('email') }}" class="form-control fw-bold py-2" required>
                        @error('email')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-5" >
                        <label for="password" class="form-label fw-bold">Kata sandi</label>
                        <input type="password" name="password" placeholder="Masukan password anda" id="password" class="form-control fw-bold py-2" required>
                        @error('password')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3" >
                        <button type="submit" class="btn btn-primary w-100 rounded-start py-2 fw-bold">Masuk</button>
                    </div>
                </form>
                <p class="text-center fw-bold">tidak memiliki akun? <a href="{{ route('member.register') }}">daftar disini</a></p>
                <p class="text-center fw-bold">lupa kata sandi? <a href="{{ route('member.forget-password') }}">ganti sandi disini</a></p>
            </div>
        </div>
    </div>
</div>
@endsection


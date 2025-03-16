@extends('components.layouts.member.auth')

@section('title', 'Login')

@push('styles')
    <link rel="stylesheet" href="{{ asset('devacademy/css/login.css') }}">
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 d-flex justify-content-center align-items-center">
                <div class="card login-card flex-md-row">
                    <div class="img-container d-none d-md-block col-md-6 p-0">
                        <img src="https://images.unsplash.com/photo-1606761568499-6d2451b23c66?q=80&w=1374&auto=format&fit=crop"
                            alt="Team collaboration" class="img-fluid">
                    </div>
                    <div class="card-body col-md-6">
                        <h3 class="text-center " data-aos="fade-up">Selamat Datang!</h3>
                        <p class="text-center text-muted mb-5" data-aos="fade-up" data-aos-delay="100">Silakan masuk
                            untuk mengakses akun Anda.</p>

                        <form id="loginForm" method="POST" action="{{ route('member.login.auth') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Masukan email Anda" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Kata Sandi</label>
                                <input type="password" id="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Masukan kata sandi Anda">
                                @error('password')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                                <p class="text-stat fw-bold">lupa kata sandi? <a
                                        href="{{ route('member.forget-password') }}">ganti disini</a></p>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2">Masuk</button>

                        </form>
                        <p class="text-center fw-bold mt-1">tidak memiliki akun? <a
                                href="{{ route('member.register') }}">daftar
                                disini</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

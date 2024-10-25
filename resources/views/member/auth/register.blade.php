@extends('components.layouts.member.auth')

@section('title', 'Daftarkan akunmu untuk mengakses kelas')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/auth.css') }} ">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card login-card d-flex flex-row">
                <div class="img-container">
                    <img src="{{ asset('nemolab/member/img/bismen.jpeg') }}" alt="Team collaboration" class="img-fluid rounded-start">
                </div>
                <div class="card-body ps-4">
                    <a href="javascript:void(0);" class="btn-back mb-4" onclick="window.history.back();">
                        <img src="{{ asset('nemolab/member/img/arrow.png') }}" alt="Back" class="back-icon">
                    </a>
                    <div class="px-3 text-center">
                        <h3 class="mb-4" data-aos="fade-left" data-aos-delay="100">DAFTARKAN AKUN KAMU!</h3>
                        <p class="fw-bold" data-aos="fade-left" data-aos-delay="200">Selangkah lebih maju menjadi ahli dengan belajar bersama Nemolab! Daftarkan akunmu sekarang juga</p>
                    </div>
                    <form id="register-form" action="{{ route('member.register.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="first-reigster-sesion" id="first-regist">
                            <div class="mb-1">
                                <label for="name" class="form-label fw-bold" data-aos="fade-left" data-aos-delay="300">Nama pengguna</label>
                                <input type="text" name="name" placeholder="Masukan nama disini" value="{{ old('name') }}"  class="form-control fw-bold" required data-aos="fade-left" data-aos-delay="400">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-1">
                                <label for="email" class="form-label fw-bold" data-aos="fade-left" data-aos-delay="500">Email</label>
                                <input type="email" name="email" placeholder="Masukan email disini" value="{{ old('email') }}" class="form-control fw-bold" required data-aos="fade-left" data-aos-delay="600">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold" data-aos="fade-left" data-aos-delay="700">Buat Kata sandi</label>
                                <input  type="password" name="password" placeholder="Masukan kata sandi disini" id="password"  class="form-control fw-bold" required data-aos="fade-left" data-aos-delay="800">
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary w-100 rounded-start fw-bold" data-aos="fade-left">Daftar</button>
                            </div>
                        </div>
                    </form>
                    <p class="text-center fw-bold" data-aos="fade-left" data-aos-delay="500">sudah memiliki akun? <a href="{{ route('member.login') }}">masuk disini</a></p>
                    <p class="text-center fw-bold" data-aos="fade-left" data-aos-delay="600">lupa kata sandi? <a href="forgot-pw.html">ganti sandi disini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

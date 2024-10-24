@extends('components.layouts.member.auth')

@section('title', 'Login Member')

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
                        <h3 class="mb-4" data-aos="fade-left" data-aos-delay="100">Lupa Kata Sandi</h3>
                        <p class="fw-bold" data-aos="fade-left" data-aos-delay="200">Masukan alamat email anda dibawah</p>
                    </div>
                    <form id="signin-form" method="POST" action="{{ route('member.login.auth') }}" class="signin-form">
                        <div class="mb-1" data-aos="fade-left" data-aos-delay="200">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" name="email" placeholder="Masukan email anda" value="{{ old('email') }}" class="form-control fw-bold" required>
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-5" data-aos="fade-left" data-aos-delay="400">
                            <button type="submit" class="btn btn-primary w-100 rounded-start fw-bold">Masuk</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



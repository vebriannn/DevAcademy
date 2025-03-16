@extends('components.layouts.member.auth')

@section('title', 'Register')

@push('styles')
    <link rel="stylesheet" href="{{ asset('devacademy/css/register.css') }}">
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
                        <h3 class="text-center" data-aos="fade-up">Selamat Datang!</h3>
                        <p class="text-center text-muted mb-5" data-aos="fade-up" data-aos-delay="100">Silakan daftarkan
                            akunmu disini</p>

                        <form id="loginForm" method="POST" action="{{ route('member.register.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nameP" class="form-label">Nama Pengguna</label>
                                <input type="text" id="nameP" name="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Masukan Nama Anda"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="posisi" class="form-label fw-bold">Pilih Posisi Anda</label>
                                <select name="profession" id="posisi"
                                    class="py-2 form-select @error('profession') is-invalid @enderror">
                                    <option value="">Pilih profesi</option>
                                    @foreach ($profession as $prof)
                                        <option value="{{ $prof->name }}"
                                            {{ old('profession') == $prof->name ? 'selected' : '' }}>
                                            {{ $prof->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('profession')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Masukan email Anda" value="{{ old('email') }}">
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
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2">Daftar</button>
                        </form>

                        <div class="text-center mt-4">
                            <p>Sudah punya akun? <a href="{{ route('member.login') }}"
                                    class="text-decoration-none">Login
                                    di sini</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

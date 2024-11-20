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
                        <img src="{{ asset('nemolab/member/img/bismen.jpeg') }}" alt="Team collaboration"
                            class="img-fluid rounded-start">
                    </div>
                    <div class="card-body">
                        <a href="{{ route('home') }}" class="btn-back mb-4">
                            <img src="{{ asset('nemolab/member/img/icon/arrow.png') }}" alt="Back" class="back-icon">
                        </a>
                        <div class="px-3 text-center">
                            <h3 class="mb-4" data-aos="fade-left" data-aos-delay="100">DAFTARKAN AKUN KAMU!</h3>
                            <p class="fw-bold" data-aos="fade-left" data-aos-delay="200">Selangkah lebih maju menjadi ahli
                                dengan belajar bersama Nemolab! Daftarkan akunmu sekarang juga</p>
                        </div>
                        <form id="register-form" action="{{ route('member.register.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="first-reigster-sesion mt-3" id="first-regist">
                                <div class="mb-3 text-center">
                                    <div class="d-flex flex-column align-items-center">
                                        <img src="{{ asset('nemolab/member/img/icon/Group 7.png') }}" alt="avatar"
                                            width="130" height="130" class="avatar class mb-3"
                                            style="border-radius: 50%; object-fit: cover" id="avatarPreview" />
                                        <input type="file" class="btn-upload " style="display: none;" id="fileUpload"
                                            name="avatar">
                                        <label for="fileUpload" class="btn btn-secondary mb-1">Upload Avatar</label>
                                    </div>
                                    @error('avatar')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="">
                                            <label for="name" class="form-label fw-bold">Nama pengguna</label>
                                            <input type="text" name="name" placeholder="Masukan nama disini"
                                                value="{{ old('name') }}" class="form-control py-2 fw-bold" required>
                                            @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="">
                                            <label for="email" class="form-label fw-bold">Email</label>
                                            <input type="email" name="email" placeholder="Masukan email disini"
                                                value="{{ old('email') }}" class="form-control py-2 fw-bold" required>
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="posisi" class="form-label fw-bold">Pilih Posisi Impian Anda</label>
                                    <select name="profession" id="posisi" class="py-2 form-select">
                                        <option value="Pelajar Jangka Panjang">Pelajar Jangka Panjang</option>
                                        <option value="UI/UX Designer">UI/UX Designer</option>
                                        <option value="Frontend Developer">Frontend Developer</option>
                                        <option value="Backend Developer">Backend Developer</option>
                                        <option value="Wordpress Developer">Wordpress Developer</option>
                                        <option value="Graphics Designer">Graphics Designer</option>
                                        <option value="Fullstack Developer">Fullstack Developer</option>
                                    </select>
                                    @error('profession')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold">Buat Kata sandi</label>
                                    <input type="password" name="password" placeholder="Masukan kata sandi disini"
                                        id="password" class="form-control py-2 fw-bold" required>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <button type="submit"
                                        class="btn btn-primary py-2 w-100 rounded-start fw-bold">Daftar</button>
                                </div>
                            </div>
                        </form>
                        <p class="text-center fw-bold">sudah memiliki akun? <a href="{{ route('member.login') }}">masuk
                                disini</a></p>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const avatarPreview = document.getElementById('avatarPreview');
            const fileUpload = document.getElementById('fileUpload');

            // Fungsi untuk memperbarui gambar pratinjau
            fileUpload.addEventListener('change', (event) => {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        avatarPreview.src = e.target.result; // Memperbarui sumber gambar pratinjau
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush

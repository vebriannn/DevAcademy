@extends('components.layouts.member.auth')

@section('title', 'reset Password Anda Sekarang!!!')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('devacademy/member/css/auth.css') }} ">
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-10 col-sm-6 mt-5">
                <div class="card login-card d-flex flex-row">
                    <div class="card-body ps-4">
                        {{-- <a href="{{ route('member.forget-password') }}" class="btn-back mb-4">
                            <img src="{{ asset('devacademy/member/img/icon/arrow.png') }}" alt="Back" class="back-icon">
                        </a> --}}
                        <div class="px-3 text-center">
                            <h3 class="mb-4" data-aos="fade-left" data-aos-delay="100">Reset Password Akunmu Di Sini!</h3>
                        </div>
                        <form action="{{ route('member.reset-password.updated') }}" class="signin-form" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <input type="hidden" name="email" value="{{ $email }}">
                            <div class="mb-1">
                                <label for="password" class="form-label fw-bold py-2">Kata sandi baru</label>
                                <input type="password" id="password" name="password" class="form-control fw-bold"
                                    placeholder="Masukan kata sandi disini" required>
                            </div>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold py-2">Konfirmasi kata sandi</label>
                                <input type="password" id="confirm-password" name="password_confirmation"
                                    class="form-control fw-bold" placeholder="Masukan kata sandi disini" required>
                            </div>
                            @error('password_confirmation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary w-100 py-2 rounded-start fw-bold"
                                    id="submitBtn">Ubah Kata Sandi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- include sweetalert --}}
    @include('sweetalert::alert')

@endsection
@push('addon-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirm-password');
            const submitButton = document.getElementById('submitBtn');

            submitButton.disabled = true;

            function validatePasswords() {
                // Enable the button only if both fields are filled and passwords match
                if (passwordInput.value === confirmPasswordInput.value) {
                    submitButton.disabled = false;
                } else {
                    submitButton.disabled = true;
                }
            }

            // Add event listeners to both password fields
            passwordInput.addEventListener('input', validatePasswords);
            confirmPasswordInput.addEventListener('input', validatePasswords);
        })
    </script>
@endpush

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
                        <h3 class="mb-4" data-aos="fade-left" data-aos-delay="100">Verifikasi Email Kamu</h3>
                        <p class="fw-bold" data-aos="fade-left" data-aos-delay="200">Kami memastikan akun email anda asli, mohon konfirmasi email anda dengan kode yang telah kami kirimkan ke email <span class="email-info fw-bold">user@example.com</span></p>
                    </div>
                    <form action="" class="signin-form" id="otpForm" onsubmit="return validateOtpForm(event)">
                        <div class="input-otp my-5">
                            <input type="text" id="otp-number-input-1" class="otp-number-input" maxlength="1" onkeyup="myFunc()" data-aos="zoom-in" data-aos-delay="300"/>
                            <input type="text" id="otp-number-input-2" class="otp-number-input" maxlength="1" onkeyup="myFunc()" data-aos="zoom-in" data-aos-delay="400"/>
                            <input type="text" id="otp-number-input-3" class="otp-number-input" maxlength="1" onkeyup="myFunc()" data-aos="zoom-in" data-aos-delay="500"/>
                            <input type="text" id="otp-number-input-4" class="otp-number-input" maxlength="1" onkeyup="myFunc()" data-aos="zoom-in" data-aos-delay="600"/>
                        </div>
                        <input class="d-none" type="text" name="otp-number" id="otp-number" maxlength="4" readonly />
                        <div class="mb-3">
                            <p class="text-center" data-aos="fade-left" data-aos-delay="400">
                                <a href="#" id="resend-link" class="disabled">kirim ulang kode</a> 
                                <span class="otp-cd" id="countdown">(0:59)</span>
                            </p>
                            <button type="submit" class="btn btn-primary w-100 rounded-start fw-bold" data-aos="fade-left" data-aos-delay="500">Konfirmasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('addon-script')
    <script>
        // Function to move focus to next/previous input field
        function myFunc() {
            let otpInputs = document.querySelectorAll('.otp-number-input');
            let otpHiddenInput = document.getElementById('otp-number');

            otpInputs.forEach((input, index) => {
                input.addEventListener('keyup', (e) => {
                    let key = e.keyCode || e.charCode;
                    if (input.value.length === 1 && index < otpInputs.length - 1 && key !== 8) {
                        otpInputs[index + 1].focus();
                    }
                    if (key === 8 && input.value.length === 0 && index > 0) {
                        otpInputs[index - 1].focus();
                    }
                    // Collecting values from each input into hidden input
                    otpHiddenInput.value = Array.from(otpInputs).map(i => i.value).join('');
                });
            });
        }
        function validateOtpForm(event) {
        event.preventDefault(); // Prevent form submission
        // Get all OTP input fields
        const otpInputs = document.querySelectorAll('.otp-number-input');
        let otpHiddenInput = document.getElementById('otp-number');
        // Check if all inputs are filled
        let otpComplete = Array.from(otpInputs).every(input => input.value.trim() !== '');

        if (otpComplete) {
            otpHiddenInput.value = Array.from(otpInputs).map(i => i.value).join('');
            window.location.href = 'login.html';
        }
        return false;
    }
    </script>    
@endpush


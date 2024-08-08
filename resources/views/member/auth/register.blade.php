@extends('components.layouts.member.login&register')

@section('title', 'Nemolab')

@section('content-register')
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div class="box rounded-5 bg-white text-center d-flex flex-column justify-content-center shadow-lg">
                    <div>
                        <img src="{{ asset('nemolab/assets/image/logo.png') }}" alt="logo" width="130" />
                    </div>
                    <div>
                        <img src="{{ asset('nemolab/assets/image/avatar.png') }}" alt="avatar" width="105" height="105"
                            style="border-radius: 50%; object-fit: cover" />
                    </div>
                    <form action="{{ route('register.auth') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-col position-relative">
                            <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" />
                            <span class="ikon"><img src="{{ asset('nemolab/assets/image/user.png') }}"
                                    width="16" /></span>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-col position-relative mt-2">
                            <input type="file" name="avatar" id="fileInput" class="file-input"
                                onchange="updateFileName()" />
                            <label for="fileInput" class="file-label" data-placeholder="Choose avatar"></label>
                            <span class="ikon"><img src="{{ asset('nemolab/assets/image/avatar_2.png') }}"
                                    width="16" /></span>
                        </div>
                        <div class="input-col position-relative mt-2">
                            <input type="email" name="email" placeholder="Email address" value="{{ old('email') }}" />
                            <span class="ikon"><img src="{{ asset('nemolab/assets/image/emailregister.png') }}"
                                    width="16" /></span>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="input-col position-relative mt-2">
                            <input type="password" name="password" placeholder="Password" id="password" />
                            <span class="ikon"><img src="{{ asset('nemolab/assets/image/password.png') }}"
                                    width="16" /></span>
                            <span class="eye"><img src="{{ asset('nemolab/assets/image/eye.png') }}" width="20"
                                    class="pass-icon opacity-25" id="pass-icon" onclick="pass()" /></span>
                            @error('password')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-grid gap-2 mt-3">
                            <button type="submit" class="btn text-white fw-semibold">Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function pass() {
            var passwordField = document.getElementById('password');
            var passIcon = document.getElementById('pass-icon');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                passIcon.classList.remove('opacity-25');
            } else {
                passwordField.type = 'password';
                passIcon.classList.add('opacity-25');
            }
        }

        function updateFileName() {
            var fileInput = document.getElementById('fileInput');
            var fileLabel = fileInput.nextElementSibling;
            if (fileInput.files.length > 0) {
                fileLabel.textContent = fileInput.files[0].name;
            } else {
                fileLabel.textContent = fileInput.dataset.placeholder;
            }
        }
    </script>
@endsection

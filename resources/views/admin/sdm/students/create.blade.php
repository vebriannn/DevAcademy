@extends('components.layouts.admin.form')

@section('title', 'Tambahkan Students')

@push('styles')
    <style>
        .password-container {
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
        }

        #togglePassword.toggle-password {
            background-color: transparent;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
        }

        #togglePassword.toggle-password:hover,
        #togglePassword.toggle-password:focus {
            background-color: transparent;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            color: #858796;
            box-shadow: none
        }

        #password.form-control {
            border: none;
            box-shadow: none;
        }

        #password.form-label {
            font-weight: 600;
            color: #34495e;
        }
    </style>
@endpush

@section('content')
    <div id="content" class="d-flex align-items-center justify-content-center" style="height: 100vh; padding: 30px 0;">
        <div class="col-12 col-sm-6" style="margin-top: 3rem;">
            <div class="card p-4 shadow">
                <h4 class="text-primary fw-bold">Form Students</h4>
                <form method="POST" action="{{ route('admin.students.create.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Vebrian Nikola Saputra" value="{{ old('name') }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Profesi --}}
                    <div class="mb-3">
                        <label class="form-label">Pilih Profesi</label>
                        @if ($professions->isEmpty())
                            <div class="alert alert-danger">
                                Data profesi tidak tersedia. Harap tambahkan profesi terlebih dahulu.
                            </div>
                        @else
                            <div class="radio-groups d-flex align-items-center flex-wrap">
                                @foreach ($professions as $profession)
                                    <div>
                                        <input type="radio" id="profesi-{{ $profession->id }}" name="profession"
                                            value="{{ $profession->name }}"
                                            {{ old('profession') == $profession->name ? 'checked' : '' }}>
                                        <label for="profesi-{{ $profession->id }}"
                                            class="m-0 p-0 mr-sm-3">{{ $profession->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @error('profession')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            placeholder="vebndev@gmail.com" value="{{ old('email') }}">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Sandi (kosongkan jika tidak ingin diubah)</label>
                        <div class="input-group password-container">
                            <input type="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="Masukkan sandi baru">
                            <button type="button" class="btn btn-outline-secondary toggle-password" id="togglePassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Tambahkan Sekarang</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    </script>
@endpush

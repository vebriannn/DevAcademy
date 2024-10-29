@extends('components.layouts.member.auth')

@section('title', 'Lengkapi Profil')

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
                        <h3 class="mb-4">ATUR INFORMASI DIRIMU</h3>
                    </div>
                    <form action="{{ route('member.register.profile.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-2 text-center">
                            <div class="d-flex flex-column align-items-center">
                                <img src="{{ asset('nemolab/member/img/Group 7.png') }}" id="avatarPreview" alt="avatar" width="130" height="130" class="avatar class mb-3" 
                                     style="border-radius: 50%; object-fit: cover" />
                                <input type="file" class="btn-upload" style="display: none;" id="fileUpload" name="avatar" accept="image/*">
                                <label for="fileUpload" class="btn btn-secondary mb-1">Upload Avatar</label>
                                @error('avatar')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="profession" class="form-label fw-bold">Pilih Profesi Anda</label>
                            <select name="profession" id="profession" class="form-select" required>
                                <option value="">Pilih Profesi</option>
                                <option value="UI/UX Designer">UI/UX Designer</option>
                                <option value="Frontend Developer">Frontend Developer</option>
                                <option value="Backend Developer">Backend Developer</option>
                                <option value="Wordpress Developer">Wordpress Developer</option>
                                <option value="Graphic Designer">Graphic Designer</option>
                            </select>
                            @error('profession')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary w-100 rounded-start fw-bold">Simpan Profil</button>
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
        document.getElementById('fileUpload').addEventListener('change', function(event) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>    
@endpush

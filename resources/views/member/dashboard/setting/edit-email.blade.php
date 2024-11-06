@extends('components.layouts.member.setting')

@section('title', 'Ubah Email Anda Di Sini')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/setting.css') }} ">
@endpush
@section('content')
    <section class="profile-saya-section" id="profile-saya-section">
        <div class="container-fluid mt-5 pt-5">
            <div class="row">

                <!-- Profile Form -->
                <div class="col-md-9 mx-auto">
                    <div class="card profile-card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <a href="{{ route('member.setting') }}" class="btn-back">
                                    <img src="{{ asset('nemolab/member/img/icon/arrow.png') }}" alt="Back"
                                        class="back-icon btn-costum">
                                </a>
                                <h5 class="title p-0 ps-3 fw-bold m-0 ">Ubah email anda</h5>
                            </div>
                            <form action="{{ route('member.setting.change-email.updated') }}" method="POST"
                                class="edit-form">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="mb-3">
                                        <label for="email" class="form-label fw-bold">Email saat ini</label>
                                        <input type="email" id="email" name="email" class="form-control fw-bold"
                                            value="{{ Auth::user()->email }}" readonly
                                            style="cursor: pointer; background-color:#E8E8E8 ;"
                                            value="{{ old('email') }}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="new_email" class="form-label fw-bold">Email Baru</label>
                                        <input type="email" id="new_email" name="new_email" class="form-control fw-bold"
                                            placeholder="Masukan email baru anda" required value="{{ old('new_email') }}">
                                        @error('new_email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <button type="submit" class="btn btn-primary w-100 rounded-start fw-bold">Simpan
                                            Perubahan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

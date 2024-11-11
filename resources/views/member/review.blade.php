
@extends('components.layouts.member.app')

@section('title', 'Nemolab - Kursus Online')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/review.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
@endpush

@section('content')
<div class="container mb-5" style="margin-top: 7rem">
        <div class="d-flex align-items-center mb-3">
            <i class="fas fa-arrow-left back-button"></i>
            <h1 class="h4 fw-bold mb-0">Review Kelas Kami</h1>
        </div>
        <div class="card">
            <div class="card-body px-5">                
                <div class="mb-4 text-center">
                    <label for="namaKelas" class="form-label" style="color: #414141">Nama Kelas:</label>
                    <p id="namaKelas" class="form-control-plaintext">{{ $course->name }}</p>
                </div>
                
                <div class="mb-4">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" id="nama" class="form-control" value="{{ auth()->user()->name }}" readonly>
                </div>
                
                <div class="mb-4">
                    <label for="karirImpian" class="form-label">Karir Impian</label>
                    <input type="text" id="karirImpian" class="form-control" value="{{ auth()->user()->profession }}" readonly>
                </div>
        
                <form action="{{ route('member.review.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <div class="mb-4">
                        <label for="reviewKelas" class="form-label">Review Kelas (maks. 100 karakter)</label>
                        <textarea id="reviewKelas" name="note" class="form-control" rows="3" maxlength="100" placeholder="Masukkan komentar anda tentang kelas ini"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Konfirmasi</button>
                </form>
                <p class="text-center text-muted mt-3">*Anda bisa melihat/mengunduh sertifikat setelah Anda memberikan review pada kelas ini</p>
            </div>
        </div>        
    </div>
    @endsection

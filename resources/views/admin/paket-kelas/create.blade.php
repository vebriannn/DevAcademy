@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Tambah Paket Video Ebook')

@section('content')
    <div class="card w-75 mt-5 mb-5" style="border: none !important;">
        <div class="card-header d-flex justify-content-between bg-transparent pb-0" style="border: none !important;">
            <h2 class="fw-semibold fs-4 mb-4" style="color: #faa907">Tambah Data</h2>
            <a href="{{ route('admin.paket-kelas') }}" class="btn btn-orange"> Kembali </a>
        </div>
        <div class="card-body pt-2">
            <form class="col-12" id="formAction" action="{{ route('admin.paket-kelas.create.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <p>Cari Kursus Video</p>
                        <div class="custom-entryarea">
                            @if (is_null($courses) || $courses->isEmpty())
                                <span style="color: red">Maaf Belum Ada Kelas</span>
                            @else
                                <select id="category" name="name_course">
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->name }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            @endif
                            @error('name_course')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <p>Cari Kursus Ebook</p>
                        <div class="custom-entryarea">
                            @if (is_null($ebooks) || $ebooks->isEmpty() )
                                <span style="color: red">Maaf Belum Ada Ebook</span>
                            @else
                                <select id="category" name="name_ebook">
                                    <div class="mb-3">
                                        @foreach ($ebooks as $ebook)
                                            <option value="{{ $ebook->name }}">{{ $ebook->name }}</option>
                                        @endforeach
                                    </div>
                                </select>
                            @endif
                            @error('name_ebook')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <p>Status</p>
                        <div class="custom-entryarea">
                            <select id="category" name="status">
                                <option value="draft">Draf</option>
                                <option value="published">Publik</option>
                            </select>
                            @error('status')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit"
                            class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white fw-semibold btn-kirim"
                            style="background-color: #faa907">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('addon-script')
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const type = document.getElementById('type');
            const price = document.getElementById('price');
            // Pastikan elemen "type" sudah ada sebelum melanjutkan
            if (type) {
                if (type.value == 'premium') {
                    price.classList.replace('d-none', 'd-block');
                } else if (type.value == 'free') {
                    price.classList.replace('d-block', 'd-none')
                    price.querySelector('input[name="price"]').value = '0';
                }

                // Event listener untuk perubahan nilai pada "type"
                type.addEventListener('change', (e) => {
                    if (e.target.value == 'premium') {
                        price.classList.replace('d-none', 'd-block');
                    } else if (e.target.value == 'free') {
                        price.classList.replace('d-block', 'd-none');
                        price.querySelector('input[name="price"]').value = '0';
                    }
                });
            }
        });
    </script> --}}
@endpush

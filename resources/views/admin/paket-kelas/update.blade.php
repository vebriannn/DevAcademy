@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Edit Paket Video Ebook')

@section('content')
    <div class="card w-75 mt-5 mb-5" style="border: none !important;">
        <div class="card-header d-flex justify-content-between bg-transparent pb-0" style="border: none !important;">
            <h2 class="fw-semibold fs-4 mb-4" style="color: #faa907">Edit Data</h2>
            <a href="{{ route('admin.paket-kelas') }}" class="btn btn-orange"> Kembali </a>
        </div>
        <div class="card-body pt-2">
            <form class="col-12" id="formAction" action="{{ route('admin.paket-kelas.edit.update', $paketKelas->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-6">
                        <p>Cari Kursus Video</p>

                            <div class="custom-entryarea">
                                <select id="category" name="name_course">
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->name }}"
                                            {{ $paketKelas->course && $paketKelas->course->name == $course->name ? 'selected' : '' }}>
                                            {{ $course->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('name_course')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                    </div>
                    <div class="col-6">
                        <p>Cari Kursus Ebook</p>
                        <div class="custom-entryarea">
                            <select id="ebook" name="name_ebook">
                                @foreach ($ebooks as $ebook)
                                    <option value="{{ $ebook->name }}"
                                        {{ $paketKelas->ebook && $paketKelas->ebook->name == $ebook->name ? 'selected' : '' }}>
                                        {{ $ebook->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('name_ebook')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <p>Status</p>
                        <div class="custom-entryarea">
                            <select id="category" name="status">
                                <option value="draft" {{ $paketKelas->status == 'draft' ? 'selected' : '' }}>Draf</option>
                                <option value="published" {{ $paketKelas->status == 'published' ? 'selected' : '' }}>Publik
                                </option>
                            </select>
                            @error('status')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <p>Tipe</p>
                        <div class="custom-entryarea">
                            <select id="type" name="type">
                                <option value="free" class="value_type" {{ $paketKelas->type == 'free' ? 'selected' : '' }}>Gratis</option>
                                <option value="premium" class="value_type" {{ $paketKelas->type == 'premium' ? 'selected' : '' }}>Berbayar</option>
                            </select>
                            @error('type')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 d-block" id="price">
                        <p>Harga</p>
                        <div class="entryarea">
                            <input type="number" id="name" name="price" placeholder="" value="{{ $paketKelas->price }}" />
                            @error('price')
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
    <script>
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
    </script>
@endpush

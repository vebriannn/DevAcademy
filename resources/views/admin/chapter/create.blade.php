@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create.css') }}">
@endpush

@section('title', 'Create Chapter')

@section('content')

    <div class="card card-custom-width" style="border: none !important;">
        <div class="card-header d-flex justify-content-between bg-transparent pb-0" style="border: none !important;">
            <h2 class="fw-semibold fs-4 mb-4" style="color: #faa907">Tambah Data</h2>
            <a href="{{ route('admin.chapter', $slug) }}" class="btn btn-orange"> Back </a>
        </div>
        <div class="card-body pt-2">
            <form class="col-12" action="{{ route('admin.chapter.create.store', $id_course) }}" method="post">
                @csrf
                <div class="entryarea">
                    <input type="text" id="name" name="name" />
                    <div class="labelline" for="name">Chapter</div>
                    @error('name')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-12 pt-2">
                    <button type="submit"
                        class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white fw-semibold btn-kirim"
                        style="background-color: #faa907">Kirim</button>
                </div>
                <div class="col-6">
                    {{-- <a href=""
                            class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white btn-batal"
                            style="background-color: gray">Reset</a> --}}
                </div>
            </form>
        </div>
    </div>

@endsection

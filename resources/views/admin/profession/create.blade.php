@extends('components.layouts.admin.form')

@section('title', 'Tambah Profesi')

@section('content')
    <div id="content" class="d-flex align-items-center justify-content-center" style="height: 100vh; padding: 30px 0;">
        <div class="col-12 col-sm-6" style="margin-top: 3rem;">
            <div class="card p-4 shadow">
                <h4 class="text-primary fw-bold">Form Profesi</h4>

                <form method="POST" action="{{ route('admin.profession.create.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Nama Tools --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Profesi</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" placeholder="Mahasiswa">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-primary">Tambahkan Sekarang</button>
                </form>
            </div>
        </div>
    </div>
@endsection

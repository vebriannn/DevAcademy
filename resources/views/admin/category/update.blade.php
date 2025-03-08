@extends('components.layouts.admin.form')

@section('title', 'Edit Kategori')

@section('content')
    <div id="content" class="d-flex align-items-center justify-content-center" style="height: 100vh; padding: 30px 0;">
        <div class="col-12 col-sm-6" style="margin-top: 3rem;">
            <div class="card p-4 shadow">
                <h4 class="text-primary fw-bold">Edit Kategori</h4>
                <form method="POST" action="{{ route('admin.category.edit.update', $category->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    {{-- Nama Kategori --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Frontend Developer" value="{{ old('name', $category->name) }}">

                        @error('name')
                            <span class="text-danger" style="font-size: 0.875rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Perbarui Kategori</button>
                </form>
            </div>
        </div>
    </div>
@endsection

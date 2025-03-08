@extends('components.layouts.admin.form')

@section('title', 'Edit Tools')

@section('content')
    <div id="content" class="d-flex align-items-center justify-content-center" style="height: 100vh; padding: 30px 0;">
        <div class="col-12 col-sm-6" style="margin-top: 3rem;">
            <div class="card p-4 shadow">
                <h4 class="text-primary fw-bold">Form Edit Tools</h4>

                <form method="POST" action="{{ route('admin.tools.edit.update', $tools->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Nama Tools --}}
                    <div class="mb-3">
                        <label for="name_tools" class="form-label">Nama Tools</label>
                        <input type="text" class="form-control @error('name_tools') is-invalid @enderror" id="name_tools"
                            name="name_tools" value="{{ old('name_tools', $tools->name_tools) }}" placeholder="HTML"
                            >
                        @error('name_tools')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Upload Logo Tools --}}
                    <div class="mb-3">
                        <label for="imageUpload" class="form-label">Upload Image Tools</label>
                        <input type="file" class="form-control @error('logo_tools') is-invalid @enderror"
                            id="imageUpload" accept="image/*" name="logo_tools">
                        <small class="text-muted">Logo saat ini: {{ $tools->logo_tools }}</small>
                        @error('logo_tools')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Link Tools --}}
                    <div class="mb-3">
                        <label for="link_tools" class="form-label">Link Tools</label>
                        <input type="text" class="form-control @error('link_tools') is-invalid @enderror" id="link_tools"
                            name="link_tools" value="{{ old('link_tools', $tools->link_tools) }}"
                            placeholder="https://devdocs.io/html" >
                        @error('link_tools')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-primary">Edit Sekarang</button>
                </form>
            </div>
        </div>
    </div>
@endsection

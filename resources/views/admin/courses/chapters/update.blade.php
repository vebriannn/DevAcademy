@extends('components.layouts.admin.form')

@section('title', 'Edit Chapter')

@section('content')
    <div id="content" class="d-flex align-items-center justify-content-center" style="height: 100vh; padding: 30px 0;">
        <div class="col-12 col-sm-6" style="margin-top: 3rem;">
            <div class="card p-4 shadow">
                <h4 class="text-primary fw-bold">Edit Chapter</h4>
                <form method="POST"
                    action="{{ route('admin.chapter.edit.update', ['slug_course' => $course->slug, 'id' => $chapter->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Chapter</label>
                        <input type="text" class="form-control" name="name" placeholder="Perkenalan" required
                            value="{{ old('name', $chapter->name) }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

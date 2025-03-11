@extends('components.layouts.admin.form')

@section('title', 'Tambahkan Chapter')

@section('content')
    <div id="content" class="d-flex align-items-center justify-content-center" style="height: 100vh; padding: 30px 0;">
        <div class="col-12 col-sm-6" style="margin-top: 3rem;">
            <div class="card p-4 shadow">
                <h4 class="text-primary fw-bold">Form Chapter</h4>
                <form method="POST" action="{{ route('admin.chapter.create.store', ['slug_course' => $course->slug]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Chapter</label>
                        <input type="text" class="form-control" name="name" placeholder="Perkenalan" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambahkan Sekarang</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@extends('components.layouts.admin.form')

@section('title', 'Tambahkan Lesson')

@section('content')
    <div id="content" class="d-flex align-items-center justify-content-center" style="height: 100vh; padding: 30px 0;">
        <div class="col-12 col-sm-6" style="margin-top: 3rem;">
            <div class="card p-4 shadow">
                <h4 class="text-primary fw-bold">Form Lesson</h4>
                <form method="POST" action="{{ route('admin.lesson.create.store', ['slug_course' => $slug_course, 'id_chapter' => $id_chapter]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Nama Lesson</label>
                        <input type="text" class="form-control" name="name" placeholder="install laravel">
                    </div>
                    <div class="mb-3">
                        <label for="lastName" class="form-label">Link Video</label>
                        <input type="text" class="form-control" name="link_videos"
                            placeholder="https://www.youtube.com/embed/78ojau4">
                    </div>
                    <button type="submit" class="btn btn-primary">Tambahkan Sekarang</button>
                </form>
            </div>
        </div>
    </div>
@endsection

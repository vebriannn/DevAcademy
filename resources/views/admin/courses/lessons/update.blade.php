@extends('components.layouts.admin.form')

@section('title', 'Edit Lesson')

@section('content')
    <div id="content" class="d-flex align-items-center justify-content-center" style="height: 100vh; padding: 30px 0;">
        <div class="col-12 col-sm-6" style="margin-top: 3rem;">
            <div class="card p-4 shadow">
                <h4 class="text-primary fw-bold">Edit Lesson</h4>
                <form method="POST"
                    action="{{ route('admin.lesson.edit.update', ['slug_course' => $slug_course, 'id_chapter' => $id_chapter, 'id_lesson' => $lesson->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lesson</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $lesson->name) }}"
                            placeholder="Nama lesson">
                    </div>
                    <div class="mb-3">
                        <label for="link_videos" class="form-label">Link Video</label>
                        <input type="text" class="form-control" name="link_videos"
                            value="{{ old('link_videos', $lesson->link_videos) }}"
                            placeholder="https://www.youtube.com/embed/78ojau4">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Lesson</button>
                </form>
            </div>
        </div>
    </div>
@endsection

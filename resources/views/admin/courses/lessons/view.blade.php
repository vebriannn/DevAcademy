@extends('components.layouts.admin.app')

@section('title', 'Lihat Data Lesson')

@section('content')
    <div class="container-fluid">

        <div class="navigate-link d-flex align-items-center my-3">
            <a href="{{ route('admin.course') }}" rel="noopener noreferrer">Kursus</a>
            <p class="m-0 p-0">/</p>
            <a href="{{ route('admin.chapter', ['slug_course' => $slug_course]) }}" rel="noopener noreferrer">Chapter</a>
            <p class="m-0 p-0">/ Lesson</p>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 ">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data Lesson</h6>
                    <a href="{{ route('admin.lesson.create', ['slug_course' => $slug_course, 'id_chapter' => $id_chapter]) }}"
                        class="btn btn-primary">Tambahkan Lesson</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Lesson</th>
                                <th>Link Video</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lessons as $lesson)
                                <tr>
                                    <td>{{ $lesson->name }}</td>
                                    <td>
                                        <a href="{{ $lesson->link_videos }}" class="btn btn-success" target="_blank">
                                            Lihat Video
                                        </a>
                                    </td>
                                    <td class="d-flex align-items-center" style="gap: 1rem;">
                                        <a href="{{ route('admin.lesson.edit', ['slug_course' => $slug_course, 'id_chapter' => $id_chapter, 'id_lesson' => $lesson->id]) }}"
                                            class="btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form
                                            action="{{ route('admin.lesson.delete', ['slug_course' => $slug_course, 'id_chapter' => $id_chapter, 'id_lesson' => $lesson->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

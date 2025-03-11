@extends('components.layouts.admin.app')

@section('title', 'Lihat Data Chapter')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="navigate-link d-flex align-items-center my-3">
            <a href="{{ route('admin.course') }}" rel="noopener noreferrer">Kursus</a>
            <p class="m-0 p-0">/ Chapter</p>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Data Chapter</h6>
                    <a href="{{ route('admin.chapter.create', $course->slug) }}" class="btn btn-primary">Tambahkan
                        Chapter</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Chapter</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chapters as $chapter)
                                <tr>
                                    <td>{{ $chapter->name }}</td>
                                    <td class="d-flex align-items-center" style="gap: 1rem;">
                                        <a href="{{ route('admin.lesson', ['slug_course' => $course->slug, 'id_chapter' => $chapter->id]) }}"
                                            class="btn btn-success">
                                            Lesson
                                        </a>
                                        <a href="{{ route('admin.chapter.edit', ['slug_course' => $course->slug, 'id' => $chapter->id]) }}"
                                            class="btn btn-primary me-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form
                                            action="{{ route('admin.chapter.delete', ['slug_course' => $course->slug, 'id' => $chapter->id]) }}"
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

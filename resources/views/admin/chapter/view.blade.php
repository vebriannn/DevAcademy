@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/category.css') }}">
@endpush

@section('title', 'View Chapter')

@section('content')

    <main role="main" class="col-md-9 ml-sm-auto col-lg-9 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1">
            <h1 class="judul-table">Chapter</h1>
            <p>
                <a href="{{ route('admin.course') }}">Course</a>
                / Chapter
            </p>
        </div>
        <div class="table-responsive px-3 py-3">
            <div class="btn-group mr-2 w-100 d-flex justify-content-between align-items-center mb-3">
                <div class="d-flex align-items-center">
                    <p class="mb-0 me-2 text-center">Show</p>
                    <select id="entries" class="form-select form-select-sm">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <p class="mb-0 me-2 text-center mx-2">entries</p>
                </div>
                <a href="{{ route('admin.chapter.create', ['slug' => $slug, 'id_course' => $id]) }}" class="tambah-data pt-2 pb-2 px-4 fw-semibold"
                    style="width: max=content; !important">Tambah</a>
            </div>

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($chapters as $chapter)
                        <tr>
                            <td>{{ $chapter->name }}</td>
                            <td>
                                <a href="{{ route('admin.lesson', ['slug' => $slug, 'id_chapter' => $chapter->id]) }}" class="btn btn-success">
                                    View Lesson
                                </a>
                                <a href="{{ route('admin.chapter.edit', ['slug' => $slug, 'id_chapter' => $chapter->id]) }}" class="me-2">
                                    <img src="{{ asset('nemolab/admin/img/edit.png') }}" alt="" width="30"
                                        height="30">
                                </a>
                                <a href="{{ route('admin.chapter.delete', $chapter->id) }}">
                                    <img src="{{ asset('nemolab/admin/img/delete.png') }}" alt=""width="30"
                                        height="30">
                                </a>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="2">Data Belum Ada</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-between px-1 py-1">
                <p class="show">Showing 10 of 10</p>
                <div class="d-flex">
                    <button class="pagination mx-1" id="prev-button">Previous</button>
                    <button class="pagination mx-1" id="next-button">Next</button>
                </div>
            </div>
        </div>
    </main>

@endsection

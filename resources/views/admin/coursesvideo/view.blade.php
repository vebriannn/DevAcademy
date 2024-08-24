@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
@endpush

@section('title', 'View Course')

@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-9 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1">
            <h1 class="judul-table">Courses Video</h1>
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
                <a href="{{ route('admin.course.create') }}" class="tambah-data pt-2 pb-2 px-4 fw-semibold"
                    style="width: max=content; !important">Tambah</a>
            </div>

            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th>Title</th>
                        <th>Deskripsi</th>
                        <th>Mentor</th>
                        <th>images</th>
                        <th>price</th>
                        <th>status</th>
                        <th>type</th>
                        <th>level</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($courses as $course)
                        <tr>
                            <td>{{ $course->category }}</td>
                            <td>{{ $course->name }}</td>
                            <td>{{ $course->description }}</td>
                            <td>{{ Auth::user()->name }}</td>
                            <td>
                                <img src="{{ asset('storage/images/covers/' . $course->cover) }}" alt=""
                                    width="150" height="100">
                            </td>
                            <td>{{ $course->price }}</td>
                            <td>{{ $course->status }}</td>
                            <td>{{ $course->type }}</td>
                            <td>{{ $course->level }}</td>
                            <td class="">
                                {{-- <a href="{{ route('admin.ebook.create') }}" class="btn btn-warning text-white mb-2">
                                    Tambah ebook
                                </a> --}}
                                <a href="{{ route('admin.chapter', $course->slug) }}" class="btn btn-success mb-2">
                                    View Chapter
                                </a>
                                <a href="{{ route('admin.course.edit', $course->id) }}" class="me-2">
                                    <img src="{{ asset('nemolab/admin/img/edit.png') }}" alt="" width="30"
                                        height="30">
                                </a>
                                <a href="{{ route('admin.course.delete', $course->id) }}">
                                    <img src="{{ asset('nemolab/admin/img/delete.png') }}" alt=""width="30"
                                        height="30">
                                </a>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="10">Data Belum Ada</td>
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

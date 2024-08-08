@extends('components.layouts.admin.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/category.css') }}">
@endpush

@section('title', 'View Category')

@section('content')
    <main class="col-md-9 ml-sm-auto col-lg-9 px-4">
        <h2 class="fw-semibold mb-4" style="color: #faa907;">Category</h2>
        <div class="table-responsive p-3">
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
                <a href="{{ route('admin.category.create') }}" class="tambah-data pt-2 pb-2 px-4 fw-semibold"
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
                    @forelse ($categories as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="{{ route('admin.category.edit', $item->id) }}" class="me-2">
                                    <img src="{{ asset('nemolab/admin/img/edit.png') }}" alt="" width="35"
                                        height="35">
                                </a>
                                <a href="{{ route('admin.category.delete', $item->id) }}">
                                    <img src="{{ asset('nemolab/admin/img/delete.png') }}" alt=""width="35"
                                        height="35">
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

                <div class="d-flex justify-content-between p-1">
                    <p class="show">Showing 10 of 10</p>
                    <div class="d-flex">
                        <button class="pagination mx-1" id="prev-button">Previous</button>
                        <button class="pagination mx-1" id="next-button">Next</button>
                    </div>
                </div>
            </div>
        </main>
    @endsection

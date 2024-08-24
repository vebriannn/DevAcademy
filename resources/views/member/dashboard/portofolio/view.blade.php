@extends('components.layouts.member.dashboard')

@section('title', 'My Portofolio')


@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/sidebar.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/member/dashboard/css/myportofolio.css') }} ">
@endpush

@section('content')
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-3 d-none d-xl-block p-4 rounded-4 text-white px-5"
                style="background-color: #faa907; width: max-content;">
                <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}" style="border-radius: 100%;"
                    alt="" width="70" class="d-flex mx-lg-auto mt-3" />
                <h4 class="m-0 mt-lg-5 mt-3 fw-semibold">{{ Auth::user()->name }}</h4>
                <p class="m-0 fw-light">Status {{ Auth::user()->role }}</p>
                <div class="mt-5">
                    <a href="{{ route('member.dashboard') }}" class="list-sidebar">
                        <img src="{{ asset('nemolab/member/img/course.png') }}" alt="" width="30" />
                        <p class="m-0">My Courses</p>
                    </a>
                    <a href="#" class="list-sidebar active">
                        <img src="{{ asset('nemolab/member/img/portofolio active.png') }}" alt="" width="30" />
                        <p class="m-0">My Portofolio</p>
                    </a>
                    <a href="dashboard-transactions.html" class="list-sidebar">
                        <img src="{{ asset('nemolab/member/img/transaksi.png') }}" alt="" width="30" />
                        <p class="m-0">Transactions</p>
                    </a>
                </div>
            </div>
            <!-- End Sidebar -->

            <!-- My Profil -->
            <div class="col-lg-9 col-md-9 col-12 mx-auto mx-lg-0 ps-lg-5 ps-3">
                <div class="my-4">
                    <h3 class="fw-semibold text-center text-lg-start" style="color: #faa907">My Portofolio</h3>
                </div>

                <div class="table-responsive p-3 rounded-5 border border-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center ms-3 mt-2">
                            <p class="mb-0 me-2">Show</p>
                            <select id="entries" class="form-select form-select-sm rounded-3">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            <p class="mb-0 ms-2">entries</p>
                        </div>
                        <a href="{{ route('member.portofolio.create') }}">Tambah</a>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Link portofolio</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($portofolio as $porto)
                                <tr>
                                    <td>
                                        {{ $porto->name }}
                                    </td>
                                    <td>
                                        {{ $porto->description }}
                                    </td>
                                    <td>
                                        {{ $porto->link }}
                                    </td>
                                    <td>
                                        {{ $porto->status }}
                                    </td>
                                    <td>
                                        @if ($porto->status == 'check')
                                            <a href="{{ route('member.portofolio.edit', $porto->id) }}" class="me-2">
                                                <img src="{{ asset('nemolab/member/img/edit.png') }}" alt=""
                                                    width="35" height="35">
                                            </a>
                                            <a href="{{ route('member.portofolio.delete', $porto->id) }}">
                                                <img src="{{ asset('nemolab/member/img/delete.png') }}" alt=""
                                                    width="35" height="35">
                                            </a>
                                        @else
                                            <p>No Action</p>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">
                                        <p style="text-align: center">Maaf Belum Ada Portofolio Yang Di Upload </p>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between p-1">
                        <p class="show">Showing 10 of 10</p>
                        <div class="d-flex gap-3">
                            <button class="pagination" id="prev-button">Previous</button>
                            <button class="pagination" id="next-button">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

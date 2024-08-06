@extends('components.layouts.superadmin.dashboard')

@section('title, data-mentor')

@section('content-data-mentor')

<link rel="stylesheet" href="{{ asset('nemolab/assets/css/components/sidebar.css') }}">

<div class="container pe-0" id="datamentor">
    <div class="row w-100">
            <!-- Sidebar -->
            <div class="col-3 d-none d-lg-block p-4 rounded-4 text-white" style="background-color: #faa907">
                <p class="tittle-list-sidebar mt-4">View Data</p>
                <a href="#" class="list-sidebar">
                    <img src="{{ asset('nemolab/assets/image/datamember.png') }}" alt="" width="30" />
                    <p class="m-0">Data Member</p>
                </a>
                <a href="#" class="list-sidebar active">
                    <img src="{{ asset('nemolab/assets/image/datamember-active.png') }}" alt="" width="30" />
                    <p class="m-0">Data Mentor</p>
                </a>
                <a href="dashboard-transactions.html" class="list-sidebar">
                    <img src="{{ asset('nemolab/assets/image/datamember.png') }}" alt="" width="30" />
                    <p class="m-0">Data Super Admin</p>
                </a>

                <a href="dashboard-transactions.html" class="list-sidebar">
                    <img src="{{ asset('nemolab/assets/image/datamember.png') }}" alt="" width="30" />
                    <p class="m-0">Data Transactions</p>
                </a>

                <a href="#" class="list sidebar d-flex">
                    <img src="{{ asset('nemolab/assets/image/datamember.png') }}" alt="" width="30"/>
                    <p class="m-0 ps-2 text-white">Pengajuan Mentor</p>
                </a>

                <p class="tittle-list-sidebar mt-4">Learn</p>
                <a href="#" class="list-sidebar">
                    <img src="{{ asset('nemolab/assets/image/datacourses.png') }}" alt="" width="30" />
                    <p class="m-0">Courses</p>
                </a>
                <a href="#" class="list-sidebar">
                    <img src="{{ asset('nemolab/assets/image/datalesson.png') }}" alt="" width="30" />
                    <p class="m-0">Lesson</p>
                </a>
                <a href="dashboard-transactions.html" class="list-sidebar">
                    <img src="{{ asset('nemolab/assets/image/datachapter.png') }}" alt="" width="30" />
                    <p class="m-0">Chapter</p>
                </a>

                <p class="tittle-list-sidebar mt-4">Category</p>
                <a href="#" class="list-sidebar">
                    <img src="{{ asset('nemolab/assets/image/datacategory.png') }}" alt="" width="30" />
                    <p class="m-0">Category</p>
                </a>
        </div>
            <!-- End Sidebar -->

            <main role="main" class="col-md-9 ml-sm-auto col-lg-9 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1">
                    <h1 class="judul-table">Data Mentor</h1>
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
                        <button class="tambah-data px-2 py-2">Tambah</button>
                    </div>
                    
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Password</th>
                                <th>Konfirm Password</th>
                            </tr>
                        </thead>
                        <tbody>
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
        </div>
</div>

@endsection
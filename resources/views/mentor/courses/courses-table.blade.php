@extends('components.layouts.superadmin.dashboard')

@section('title, data-course-mentor')

@section('content-courses-table-mentor')
<link rel="stylesheet" href="{{ asset('nemolab/assets/css/mentorcoursestable.css') }}">
<link rel="stylesheet" href="{{ asset('nemolab/assets/css/components/sidebar.css') }}">

<div class="container" id="mentor">
    <div class="row w-100">
        <!-- Sidebar -->
        <div class="col-3 d-none d-lg-block p-4 rounded-4 text-white" style="background-color: #faa907">
                <a href="#" class="list-sidebar active">
                    <img src="{{ asset('nemolab/assets/image/active-mentor.png') }}" alt="" width="30" />
                    <p class="m-0">Mentor</p>
                </a>
        </div>
        <!-- End Sidebar -->

            <!-- Main Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-9 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-1">
                    <h1 class="judul-table">Courses</h1>
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
                                <th>Kategori</th>
                                <th>Title</th>
                                <th>Deskripsi</th>
                                <th>Mentor</th>
                                <th>Image</th>
                                <th>Link</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>John Doe</td>
                                <td>johndoe@example.com</td>
                                <td>password123</td>
                                <td>Vero</td>
                                <td><img src="https://via.placeholder.com/150" alt="Image" class="table-img img-fluid"></td>
                                <td><a href="www.example.com">Website</a></td>
                                <td>
                                    <a href="#" class="edit-data px-2 py-2">Edit</a>
                                    <a href="#" class="edit-data px-2 py-2">Hapus</a>
                                </td>
                            </tr>
                            
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
            <!-- End Main Content -->
    </div>
</div>

        
@endsection

@extends('components.layouts.superadmin.dashboard')

@section('title', 'Data Member')

@section('content-data-member')

<link rel="stylesheet" href="{{ asset('nemolab/assets/css/components/sidebar.css') }}">

<div class="container pe-0" id="datamember">
    <div class="row w-100">
        <!-- Sidebar -->
        <div class="col-3 d-none d-lg-block p-4 rounded-4 text-white" style="background-color: #faa907">
            <p class="tittle-list-sidebar mt-4">View Data</p>
            <a href="{{ route('admin.member') }}" class="list-sidebar active">
                <img src="{{ asset('nemolab/assets/image/datamember-active.png') }}" alt="" width="30" />
                <p class="m-0">Data Member</p>
            </a>
            <a href="{{ route('admin.mentor') }}" class="list-sidebar">
                <img src="{{ asset('nemolab/assets/image/datamember.png') }}" alt="" width="30" />
                <p class="m-0">Data Mentor</p>
            </a>
            <a href="{{ route('admin.superadmin') }}" class="list-sidebar">
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

        <!-- Content -->            
        <main role="main" class="col-lg-9 col-sm-12 ps-lg-5 ps-sm-0">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-1">
                <h1 class="judul-table">Data Member</h1>
            </div>
    
            <div class="table-responsive px-3 py-3">
                <div class="btn-group mr-2 w-100 d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center">
                        <p class="mb-0 me-2 text-center">Show</p>
                        <form method="GET" action="{{ route('admin.member') }}" id="entries-form">
                            <select id="entries" name="entries" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="10" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('entries') == 100 ? 'selected' : '' }}>100</option>
                            </select>
                            
                        </form>
                        <p class="mb-0 me-2 text-center mx-2">entries</p>
                    </div>
                    <a href="{{ route('admin.member.create') }}" class="tambah-data px-2 py-2">Tambah</a>
                </div>
                
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->email }}</td>
                                <td>{{ $student->password }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No students found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <div class="d-flex justify-content-between px-1 py-1">
                    <p class="show">Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }}</p>
                    <div class="d-flex">
                        <!-- Custom Pagination -->
                        <button class="pagination mx-1 {{ $students->onFirstPage() ? 'disabled' : '' }}" id="prev-button" {{ $students->onFirstPage() ? 'disabled' : '' }} data-url="{{ $students->previousPageUrl() }}">Previous</button>
                        <button class="pagination mx-1 {{ $students->hasMorePages() ? '' : 'disabled' }}" id="next-button" {{ $students->hasMorePages() ? '' : 'disabled' }} data-url="{{ $students->nextPageUrl() }}">Next</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
    document.getElementById('prev-button').addEventListener('click', function() {
        if (!this.classList.contains('disabled')) {
            window.location.href = this.getAttribute('data-url');
        }
    });

    document.getElementById('next-button').addEventListener('click', function() {
        if (!this.classList.contains('disabled')) {
            window.location.href = this.getAttribute('data-url');
        }
    });
</script>

@endsection

@extends('components.layouts.admin.app')

@section('title', 'Lihat Data Superadmin')

@section('content')
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Superadmin</h6>
                {{-- <a href="{{ route('admin.mentor.create') }}" class="btn btn-primary">Tambahkan Mentor</a> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Profesi</th>
                                <th>Total Kelas</th>
                                <th>Email</th>
                                <th>Email Verifikasi</th>
                                <th>Sandi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($superadmins as $admin)
                                <tr>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->profession ?? 'Tidak ada profesi' }}</td>
                                    <td>{{ $admin->courses->count() }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td class="{{ $admin->email_verified_at ? 'text-success' : 'text-danger' }}">
                                        {{ $admin->email_verified_at ? 'Terverifikasi' : 'Belum Terverifikasi' }}
                                    </td>
                                    <td>******</td>
                                    <td class="d-sm-flex justify-content-around">-</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection

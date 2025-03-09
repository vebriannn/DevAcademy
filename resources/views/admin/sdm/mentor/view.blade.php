@extends('components.layouts.admin.app')

@section('title', 'Lihat Data Mentor')

@section('content')
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Mentor</h6>
                <a href="{{ route('admin.mentor.create') }}" class="btn btn-primary">Tambahkan Mentor</a>
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
                            @foreach ($mentors as $mentor)
                                <tr>
                                    <td>{{ $mentor->name }}</td>
                                    <td>{{ $mentor->profession ?? 'Tidak ada profesi' }}</td>
                                    <td>{{ $mentor->courses->count() }}</td>
                                    <td>{{ $mentor->email }}</td>
                                    <td class="{{ $mentor->email_verified_at ? 'text-success' : 'text-danger' }}">
                                        {{ $mentor->email_verified_at ? 'Terverifikasi' : 'Belum Terverifikasi' }}
                                    </td>
                                    <td>******</td>
                                    <td class="d-sm-flex justify-content-around">
                                        <a href="{{ route('admin.mentor.edit', $mentor->id) }}"
                                            class="btn btn-primary mb-2 mb-sm-0">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.mentor.delete', $mentor->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="id" value="{{ $mentor->id }}">
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

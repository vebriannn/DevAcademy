@extends('components.layouts.admin.app')

@section('title', 'Lihat Data Students')

@section('content')
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Students</h6>
                <a href="{{ route('admin.students.create') }}" class="btn btn-primary">Tambahkan Students</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Profesi</th>
                                <th>Email</th>
                                <th>Email Verifikasi</th>
                                <th>Sandi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->profession }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td class="{{ $student->email_verified_at ? 'text-success' : 'text-danger' }}">
                                        {{ $student->email_verified_at ? 'Terverifikasi' : 'Belum Terverifikasi' }}
                                    </td>
                                    <td>******</td>
                                    <td class="d-sm-flex justify-content-around">
                                        <a href="{{ route('admin.students.edit', $student->id) }}"
                                            class="btn btn-primary mb-2 mb-sm-0">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.students.delete', $student->id) }}" method="POST">
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


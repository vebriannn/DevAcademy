@extends('components.layouts.admin.app')

@section('title', 'Lihat Data Profesi')

@section('content')
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Profesi</h6>
                @if (Auth::user()->role == 'superadmin')
                    <a href="{{ route('admin.profession.create') }}" class="btn btn-primary">Tambahkan Profesi</a>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Profesi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($professions as $profession)
                                <tr>
                                    <td>{{ $profession->name }}</td>
                                    <td class="d-flex align-items-center" style="gap: 1rem;">
                                        @if (Auth::user()->role == 'superadmin')
                                            <a href="{{ route('admin.profession.edit', $profession->id) }}"
                                                class="btn btn-primary me-2">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('admin.profession.delete', $profession->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            -
                                        @endif
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

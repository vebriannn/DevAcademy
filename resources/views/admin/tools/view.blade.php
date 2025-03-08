@extends('components.layouts.admin.app')

@section('title', 'Lihat Data Tools')

@section('content')
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Tools</h6>
                <a href="{{ route('admin.tools.create') }}" class="btn btn-primary">Tambahkan Tools</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Tools</th>
                                <th>Logo Tools</th>
                                <th>Link Tools</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tools as $tool)
                                <tr>
                                    <td>{{ $tool->name_tools }}</td>
                                    <td>
                                        <img src="{{ asset('storage/images/logoTools/' . $tool->logo_tools) }}"
                                            alt="{{ $tool->name_tools }} Logo" width="40" height="40">
                                    </td>
                                    <td>
                                        <a href="{{ $tool->link_tools }}" class="btn btn-success"
                                            target="_blank">Kunjungi</a>
                                    </td>
                                    <td class="d-flex align-items-center" style="gap: 1rem;">
                                        <a href="{{ route('admin.tools.edit', $tool->id) }}" class="btn btn-primary me-2">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.tools.delete', $tool->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus ini?');">
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

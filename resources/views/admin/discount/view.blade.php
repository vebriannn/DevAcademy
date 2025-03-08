@extends('components.layouts.admin.app')

@section('title', 'Lihat Data Diskon')

@section('content')
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Diskon</h6>
                <a href="{{ route('admin.discount.create') }}" class="btn btn-primary">Tambahkan Diskon</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kode Diskon</th>
                                <th>Persentase Diskon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($discounts as $discount)
                                <tr>
                                    <td>{{ $discount->code_discount }}</td>
                                    <td>{{ $discount->rate_discount }}%</td>
                                    <td class="d-flex align-items-center" style="gap: 1rem;">
                                        <!-- Tombol Edit -->
                                        <a href="{{ route('admin.discount.edit', $discount->id) }}"
                                            class="btn btn-primary me-2">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Form Hapus -->
                                        <form action="{{ route('admin.discount.delete', $discount->id) }}" method="POST"
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

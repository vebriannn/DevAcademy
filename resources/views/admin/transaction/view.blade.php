@extends('components.layouts.admin.app')

@section('title', 'Lihat Data Transaksi')

@section('content')
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
                <!-- <a href="#" class="btn btn-primary">Tambahkan Transaksi</a> -->
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Invoice Pembeli</th>
                                <th>Nama Pembeli</th>
                                <th>Nama Kelas</th>
                                <th>Tipe Kelas</th>
                                <th>Harga Kelas</th>
                                <th>Status Kelas</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->transaction_code }}</td>
                                    <td>{{ $transaction->user->name ?? 'Guest' }}</td>
                                    <td>{{ $transaction->name_class }}</td>
                                    <td>{{ $transaction->type_class }}</td>
                                    <td>Rp. {{ number_format($transaction->price, 0, ',', '.') }}</td>

                                    <!-- Status dengan warna -->
                                    <td
                                        class="
                                    {{ $transaction->status == 'pending' ? 'text-warning' : '' }}
                                    {{ $transaction->status == 'success' ? 'text-success' : '' }}
                                    {{ $transaction->status == 'failed' ? 'text-danger' : '' }}">
                                        {{ ucfirst($transaction->status) }}
                                    </td>

                                    <td>{{ $transaction->created_at->format('d/m/Y') }}</td>

                                    <!-- Action -->
                                    <td class="d-flex align-items-center" style="gap: 1rem;">
                                        @if (Auth::user()->role == 'superadmin')
                                            @if ($transaction->status == 'pending')
                                                <!-- Tombol Batalkan -->
                                                <form action="{{ route('admin.transaction.cancel', $transaction->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="failed">
                                                    <button type="submit" class="btn btn-danger">
                                                        Batalkan
                                                    </button>
                                                </form>

                                                <!-- Tombol Selesaikan -->
                                                <form action="{{ route('admin.transaction.accept', $transaction->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="status" value="success">
                                                    <button type="submit" class="btn btn-success">
                                                        Selesaikan
                                                    </button>
                                                </form>
                                            @else
                                                <!-- Jika bukan pending -->
                                                <span>-</span>
                                            @endif
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
@push('scripts')
    <script>
        $('#dataTable').DataTable({
            "order": [], // Mematikan default sorting
            "columnDefs": [{
                    "orderable": false,
                    "targets": [7]
                } // Kolom aksi (ke-8) tidak bisa disort
            ]
        });
    </script>
@endpush

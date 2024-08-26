@extends('components.layouts.member.app')

@section('title', 'Transactions')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/sidebar.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/tabel-content.css') }}">
@endpush

@section('content')
    <div class="container" style="margin-top: 5rem;">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-3 d-none d-xl-block p-4 pb-5 rounded-4 text-white px-5"
                style="background-color: #faa907; width: max-content;">
                <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}" style="border-radius: 100%;"
                    alt="" width="70" height="70" class="d-flex mx-lg-auto mt-3" />
                <h4 class="m-0 mt-lg-5 mt-3 fw-semibold">{{ Auth::user()->name }}</h4>
                <p class="m-0 fw-light">Status {{ Auth::user()->role }}</p>
                <div class="mt-5">
                    <a href="{{ route('member.dashboard') }}" class="list-sidebar">
                        <img src="{{ asset('nemolab/member/img/course.png') }}" alt="" width="30" />
                        <p class="m-0">My Courses</p>
                    </a>
                    <a href="{{ route('member.portofolio') }}" class="list-sidebar">
                        <img src="{{ asset('nemolab/member/img/portofolio.png') }}" alt="" width="30" />
                        <p class="m-0">My Portofolio</p>
                    </a>
                    <a href="{{ route('member.transaction') }}" class="list-sidebar active">
                        <img src="{{ asset('nemolab/member/img/transaksi active.png') }}" alt="" width="30" />
                        <p class="m-0">Transactions</p>
                    </a>
                </div>
            </div>
            <!-- End Sidebar -->

            <!-- Tabel -->
            <div class="col-lg-9 col-md-9 col-12 mx-auto mx-lg-0 ps-lg-5 ps-3">
                <div class="my-4">
                    <h3 class="fw-semibold text-center text-lg-start" style="color: #faa907">My Transactions</h3>
                </div>

                <div class="table-responsive p-3 rounded-5 border border-2">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center ms-3 mt-2">
                            <p class="mb-0 me-2 text-center">Show</p>
                            <form method="GET" action="{{ route('member.transaction') }}" id="entries-form">
                                <select id="entries" name="per_page" class="form-select form-select-sm"
                                    onchange="this.form.submit()">
                                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                            </form>
                            <p class="mb-0 me-2 text-center mx-2">entries</p>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Cover</th>
                                <th>Product Name</th>
                                <th>Type</th>
                                <th>Price</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/images/covers/' . $transaction->course->cover) }}"
                                            alt="Cover" width="90" height="auto" />
                                    </td>
                                    <td class="text-capitalize">{{ $transaction->name }}</td>
                                    <td class="text-capitalize">{{ $transaction->course->type }}</td>
                                    <td class="text-capitalize">Rp {{ number_format($transaction->price, 2, ',', '.') }}
                                    </td>
                                    <td class="text-capitalize">{{ $transaction->created_at->format('d-M-Y') }}</td>
                                    @if ($transaction->status === 'success')
                                        <td class="text-capitalize text-success">{{ ucfirst($transaction->status) }}</td>
                                    @elseif($transaction->status === 'failed')
                                        <td class="text-capitalize text-danger">{{ ucfirst($transaction->status) }}</td>
                                    @else
                                        <td class="text-capitalize text-warning">{{ ucfirst($transaction->status) }}</td>
                                    @endif
                                    <td>
                                        @if ($transaction->status === 'pending')
                                            <form action="{{ route('member.transaction.cancel', $transaction->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apa anda yakin ingin membatalkan transaksi?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Batalkan
                                                    Pembelian</button>
                                            </form>
                                        @elseif ($transaction->status === 'failed')
                                            <form action="{{ route('member.transaction.cancel', $transaction->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apa anda yakin ingin membatalkan transaksi?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus
                                                    Transaksi</button>
                                            </form>
                                        @else
                                            <div>
                                                -
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-between p-1">
                        <p class="show">Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of
                            {{ $transactions->total() }}</p>
                        <div class="d-flex gap-3">
                            <!-- Custom Pagination -->
                            <button class="pagination mx-1 {{ $transactions->onFirstPage() ? 'disabled' : '' }}"
                                id="prev-button" {{ $transactions->onFirstPage() ? 'disabled' : '' }}
                                data-url="{{ $transactions->previousPageUrl() }}">Previous</button>
                            <button class="pagination mx-1 {{ $transactions->hasMorePages() ? '' : 'disabled' }}"
                                id="next-button" {{ $transactions->hasMorePages() ? '' : 'disabled' }}
                                data-url="{{ $transactions->nextPageUrl() }}">Next</button>
                        </div>
                    </div>
                </div>
            </div>
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

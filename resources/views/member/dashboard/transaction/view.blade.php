@extends('components.layouts.member.app')

@section('content')
<link rel="stylesheet" href="{{ asset('nemolab/components/member/css/sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('nemolab/member/css/tabel.css') }}">
<div class="container">
    <div class="row">
        <!-- Tabel -->
        <div class="col-lg-12 col-md-9 col-12 mx-auto mx-lg-0 ps-lg-5 ps-3">
            <div class="my-4">
                <h3 class="fw-semibold text-center text-lg-start" style="color: #faa907">My Transactions</h3>
            </div>

            <div class="table-responsive p-3 rounded-5 border border-2">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center ms-3 mt-2">
                        <p class="mb-0 me-2">Show</p>
                        <form method="GET" action="{{ route('member.transaction') }}" id="entries-form">
                            <select id="entries" name="per_page" class="form-select form-select-sm rounded-3" onchange="document.getElementById('entries-form').submit();">
                                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                            </select>
                        </form>
                        <p class="mb-0 ms-2">entries</p>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Cover</th>
                            <th>Name</th>
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
                                    <img src="{{ asset('storage/images/covers/' . $transaction->course->cover) }}" alt="Cover" width="90" height="auto" />
                                </td>
                                <td>{{ $transaction->course->name }}</td>
                                <td>{{ $transaction->course->type }}</td>
                                <td>Rp {{ number_format($transaction->course->price, 2, ',', '.') }}</td>
                                <td>{{ $transaction->created_at->format('d-M-Y') }}</td>
                                <td>{{ ucfirst($transaction->status) }}</td>
                                <td>
                                    @if ($transaction->status === 'pending')
                                        <form action="{{ route('member.transaction.cancel', $transaction->id) }}" method="POST" onsubmit="return confirm('Apa anda yakin ingin membatalkan transaksi?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-between p-1">
                    <p class="show">Showing {{ $transactions->count() }} of {{ $transactions->total() }}</p>
                    <div class="d-flex gap-3">
                        <button class="pagination mx-1 {{ $transactions->onFirstPage() ? 'disabled' : '' }}" id="prev-button" {{ $transactions->onFirstPage() ? 'disabled' : '' }} data-url="{{ $transactions->previousPageUrl() }}">Previous</button>
                        <button class="pagination mx-1 {{ $transactions->hasMorePages() ? '' : 'disabled' }}" id="next-button" {{ $transactions->hasMorePages() ? '' : 'disabled' }} data-url="{{ $transactions->nextPageUrl() }}">Next</button>
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

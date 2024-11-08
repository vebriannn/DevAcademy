@extends('components.layouts.member.dashboard')

@section('title', 'Nemolab - Lihat informasi dan perkembangan anda disini')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/sidebar-dashboard.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/dashboard-css/transaction.css') }} ">
@endpush
@section('content')
    <section class="section-pilih-kelas" id="section-pilih-kelas">
        <div class="container-fluid mt-5 pt-5">
            <div class="row">
                @include('components.includes.member.sidebar-dashboard')
                <div class="col-12 col-lg-9">
                    <!-- Navigation Tabs -->
                    <div class="filter-transaction">
                        <ul class="nav-tabs">
                            <li><a href="#" class="active">Semua</a></li>
                            <li><a href="#">Berhasil</a></li>
                            <li><a href="#">Pending</a></li>
                            <li><a href="#">Gagal</a></li>
                        </ul>
                    </div>

                    <!-- Transaction Cards -->
                    @foreach ($transactions as $transaction)
                        <div class="card mt-3">
                            <div class="card-body d-flex align-items-center">
                                <img alt="Course image"
                                    src="{{ asset('storage/images/covers/' . $transaction->course->cover) }}" height="80"
                                    width="120" class="cover me-3" />
                                <div class="details">
                                    <p class="title">{{ $transaction->name }}</p>
                                    <p class="Premium">Kelas Premium</p>
                                    <div class="info mt-3">
                                        <p class="price">Harga: Rp. {{ number_format($transaction->amount, 0, ',', '.') }}
                                        </p>
                                        <p class="date">Tanggal: {{ $transaction->created_at->format('d-M-Y') }}</p>
                                        <p class="status">Status:</p>
                                        <p class="status-info"
                                            style="color: {{ $transaction->status === 'success' ? 'green' : ($transaction->status === 'pending' ? 'orange' : 'red') }};">
                                            {{ ucfirst($transaction->status) }}
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    @if ($transaction->status === 'pending')
                                        <form action="{{ route('member.transaction.cancel', $transaction->id) }}"
                                            class="d-flex gap-2" method="POST"
                                            onsubmit="return confirm('Apa anda yakin ingin membatalkan transaksi?');">
                                            @csrf
                                            @method('DELETE')
                                            {{-- <a href="" class="btn btn-success btn-sm">Bayar Kelas</a> --}}
                                            <button type="submit" class="btn btn-danger btn-sm">Batalkan
                                                Pembelian</button>
                                            <a href="{{ route('member.transaction.view-transaction', $transaction->transaction_code) }}"
                                                class="btn btn-primary">
                                                Bayar
                                            </a>
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
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Button for Load More -->
                    {{-- <div class="btn-more mt-lg-5 d-flex justify-content-center">
                        <button class="btn btn-primary d-inline-flex align-items-center">
                            Tampilkan Lebih Banyak
                            <span class="d-flex align-items-center">
                                <box-icon name='chevron-down' color="#414142"></box-icon>
                            </span>
                        </button>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
    @include('components.includes.member.sidebar-dashboard-mobile')
@endsection
@push('addon-script')
    {{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
    const sidebarLinks = document.querySelectorAll(".nav-tabs li a");
    sidebarLinks.forEach(link => {
        if (link.href === window.location.href) {
            link.parentElement.classList.add("active");
        } else {
            link.parentElement.classList.remove("active");
        }
    });
}); --}}
    </script>
    <script>
        function elementFollowScroll(object, sectionContainer, topMargin, stopOn = false, footer) {
            $(window).on("scroll", function() {
                if ($(window).width() > 962) {
                    let originalY = sectionContainer.offset().top;
                    let scrollTop = $(window).scrollTop();
                    let footerTop = footer.offset().top;
                    let sidebarHeight = object.outerHeight(true);
                    let stopPoint = footerTop - sidebarHeight - topMargin;

                    if (stopOn === false) {
                        let newTop = scrollTop < originalY ? 0 : scrollTop - originalY + topMargin;
                        if (scrollTop + sidebarHeight + topMargin >= footerTop) {
                            object.stop(false, false).animate({
                                top: stopPoint - originalY
                            }, 50);
                        } else {
                            object.stop(false, false).animate({
                                top: newTop
                            }, 50);
                        }
                    } else {
                        let newTop = scrollTop < originalY ? 0 : Math.min(sectionContainer.height() - object
                            .height() - 52, scrollTop - originalY + topMargin);
                        if (scrollTop + sidebarHeight + topMargin >= footerTop) {
                            object.stop(true, true).animate({
                                top: stopPoint - originalY
                            }, 50);
                        } else {
                            object.stop(true, true).animate({
                                top: newTop
                            }, 50);
                        }
                    }
                } else {
                    object.stop(false, false).css({
                        top: 0
                    });
                }
            });
        }
        $(document).ready(function() {
            // Inisialisasi sidebar sticky
            const sidebar = $(".sidebar");
            const sectionContainer = $(".col-md-3");
            const topMargin = 90;
            const footer = $("footer");
            elementFollowScroll(sidebar, sectionContainer, topMargin, false, footer);
        });
    </script>
@endpush

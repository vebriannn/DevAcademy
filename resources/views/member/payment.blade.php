@extends('components.layouts.member.app')

@section('title', 'Nemolab - Selesaikan Pemabayaran Anda')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/payment.css') }}">
@endpush

@section('content')
<section class="payment py-5 mt-5">
    <div class="container">
        <h2 class="text-center mb-3 fw-bold">Silahkan Selesaikan Pembelian Kelas</h2>
        <p class="text-center description">Setelah pembelian kelas sukses, anda dapat mengakses kelas dan mendapatkan benefit lainnya seperti grup diskusi dan sertifikat resmi dari kami</p>

        @if ($course->price == 0)
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                <div class="card card-bayar shadow p-4">
                    <h2 class="text-rinci mb-4">Rincian Pembayaran</h2>
    
                    <div class="nota">
                        <div class="produk mb-3">
                            <p class="mb-1">Kelas yang Dibeli</p>
                            <h6 class="fw-bold">{{ $course->name }}</h6>
                        </div>
    
                        <div class="harga mb-3">
                            <div class="d-flex justify-content-between">
                                <p class="item mb-1 fw-bold">Harga Kelas</p>
                                <p class="price mb-1 fw-bold">Rp. 0</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="item mb-1 fw-bold">PPN (11%)</p>
                            <p class="tax mb-1 fw-bold">+ Rp. {{ number_format($course->price * 0.11, 0) }}</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="item mb-1 fw-bold">Biaya Service Tambahan</p>
                            <p class="tax mb-1 fw-bold">+ Rp. 0</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <p class="item mb-1 fw-bold">Potongan Kode Promo</p>
                            <p class="diskon-total mb-1 fw-bold">Tidak Ada</p>
                        </div>
    
                        <div class="total d-flex justify-content-between align-items-center">
                            <h6 class="fw-bold fs-4">Total Harga</h6>
                            <p class="fw-bold fs-4">Rp. 0</p>
                        </div>
                        
                        @php
                        $totalPrice = $course->price * 1.11 + 5000;
                        @endphp
    
                        <div class="text-center mt-1">
                            <form id="paymentForm" action="{{ route('member.transaction.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <input type="hidden" name="price" value="{{ $totalPrice }}">
                                <div class="form-check mt-4">
                                    <input class="form-cek" type="checkbox" id="termsCheck" name="termsCheck">
                                    <label class="form-check-label ms-2" for="termsCheck">
                                        Saya menyetujui <a href="#" class="syarat">Syarat & Ketentuan</a>
                                        <p class="text-danger d-none" id="important" style="font-size: 12px;">
                                            Anda harus menyetujui syarat dan ketentuan sebelum melanjutkan.
                                        </p>
                                    </label>
                                </div>
                                <button class="btn btn-primary mt-4" type="submit">Beli Kelas</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
            <!-- Pop up redeem -->
            <div class="card-redeem mb-3">
                <div class="d-flex justify-content-between align-items-center px-2 py-2">
                    <h5 class="fw-bold my-2">Gunakan Kode Promo</h5>
                    <button class="btn-close" aria-label="Close" id="close-redeem"></button>
                </div>
                <div class="redeem-content">
                    <div>
                        <p class="text-center my-auto text-body-secondary fw-bold">Promo Belum Tersedia</p>
                    </div>
                </div>
                <form action="" class="px-4 py-3">
                    <div class="redeem-form justify-content-end">
                        <button class="py-2 px-4" type="submit">Gunakan</button>
                    </div>
                </form>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-6 mt-5">
                    <div class="card card-bayar shadow p-4">
                        <h2 class="text-rinci mb-4">Rincian Pembayaran</h2>

                        <div class="promo d-flex justify-content-between align-items-center mb-3">
                            <p class="mb-0 fw-bold">Gunakan Kode Promo</p>
                            <a href="#" class="btn-promo" id="claim-promo">Klaim Promo</a>
                        </div>

                        <div class="nota">
                            <div class="produk mb-3">
                                <p class="mb-1">Kelas yang Dibeli</p>
                                <h6 class="fw-bold">{{ $course->name }}</h6>
                            </div>

                            <div class="harga mb-3">
                                <div class="d-flex justify-content-between">
                                    <p class="item mb-1 fw-bold">Harga Kelas</p>
                                    <p class="price mb-1 fw-bold">Rp. {{ number_format($course->price, 0) }}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="item mb-1 fw-bold">PPN (11%)</p>
                                    <p class="tax mb-1 fw-bold">+ Rp. {{ number_format($course->price * 0.11, 0) }}</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="item mb-1 fw-bold">Biaya Service Tambahan</p>
                                    <p class="tax mb-1 fw-bold">+ Rp. 5.000</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <p class="item mb-1 fw-bold">Potongan Kode Promo</p>
                                    <p class="diskon-total mb-1 fw-bold">Tidak Ada</p>
                                </div>
                            </div>

                            @php
                                $totalPrice = $course->price * 1.11 + 5000;
                            @endphp

                            <div class="total d-flex justify-content-between align-items-center">
                                <h6 class="fw-bold fs-4">Total Harga</h6>
                                <p class="fw-bold fs-4">Rp. {{ number_format($totalPrice, 0) }}</p>
                            </div>

                            <div class="text-center mt-1">
                                <form id="paymentForm" action="{{ route('member.transaction.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                    <input type="hidden" name="price" value="{{ $totalPrice }}">
                                    <div class="form-check mt-4">
                                        <input class="form-cek" type="checkbox" id="termsCheck" name="termsCheck">
                                        <label class="form-check-label ms-2" for="termsCheck">
                                            Saya menyetujui <a href="#" class="syarat">Syarat & Ketentuan</a>
                                            <p class="text-danger d-none" id="important" style="font-size: 12px;">
                                                Anda harus menyetujui syarat dan ketentuan sebelum melanjutkan.
                                            </p>
                                        </label>
                                    </div>
                                    <button class="btn btn-primary mt-4" type="submit">Beli Kelas</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
@push('addon-script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get the elements
        const claimPromoBtn = document.getElementById("claim-promo");
        const closeRedeemBtn = document.getElementById("close-redeem");
        const cardRedeem = document.querySelector(".card-redeem");
        const overlay = document.createElement('div');
        
        // Add the overlay to the DOM
        overlay.className = 'overlay';
        document.body.appendChild(overlay);

        // Function to open the redeem card
        function openRedeem() {
            cardRedeem.style.display = "block";
            overlay.style.display = "block"; // Show the overlay
        }

        // Function to close the redeem card
        function closeRedeem() {
            cardRedeem.style.display = "none";
            overlay.style.display = "none"; // Hide the overlay
        }

        // Event listeners
        claimPromoBtn.addEventListener("click", openRedeem);
        closeRedeemBtn.addEventListener("click", closeRedeem);
        overlay.addEventListener("click", closeRedeem); // Close when clicking the overlay
    });
</script>
    
@endpush
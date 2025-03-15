@extends('components.layouts.member.app')

@section('title', 'Devacademy - Detail Kursus')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('devacademy/member/css/joincourse.css') }}">
@endpush

@section('content')
<main class="container mt-5 pt-5 pb-5">
    <div class="row">
        <!-- Kolom Kiri -->
        <div class="layout-kiri col-md-8">
            <h3 data-aos="fade-right" style="word-wrap: break-word; white-space: normal;">{{ $ebooks->name }}</h3>
            <div class="card-preview mb-3">
                @if ($ebooks->cover != null)
                    <img src="{{ asset('storage/images/covers/' . $ebooks->cover) }}" alt="">
                @else
                    <img src="{{ asset('devacademy/member/img/NemolabBG.jpg') }}" alt="">
                @endif
            </div>
            <div class="card mb-3 d-md-none">
                <div class="card-buy-body">
                    <p class="paket text-center mt-2 mb-0">Ebook</p>
                    <h3 class="card-title text-center mt-3" data-aos="zoom-out" data-aos-delay="100">Mulai Belajar Kursus Ini</h3>
                    <p class="text-center mx-3" data-aos="zoom-out" data-aos-delay="200">Belajar dimanapun dan kapanpun bersama kami, dan dapatkan akses kelas selamanya dengan bergabung di kursus ini</p>
                    <div class="benefit ms-3">
                        <ul class="check-active-group mt-3 list-unstyled">
                            <ul class="check-active-group mt-3 list-unstyled">
                                <li class="check-active d-flex align-items-center mt-2" data-aos="zoom-out" data-aos-delay="100">
                                    <img src="{{ asset('devacademy/member/img/check-active.png') }}" alt="Check">
                                    <p class="m-0 p-0 ms-2">Akses Ebook selamanya</p>
                                </li>
                            </ul>
                        </ul>
                    </div>
                    <div class="p-0">
                        @if ($ebooks->price != 0)
                            <h3 class="price text-center">Rp{{ number_format($ebooks->price, 0, ',', '.') }}</h3>
                        @else
                            <h3 class="price text-center">Gratis</h3>
                        @endif

                        @if ($transaction)
                            @if ($transaction->status == 'pending')
                                <a href="#" class="buy btn btn-warning w-100">Dalam Proses Pembayaran</a>
                            @elseif ($transaction->status == 'success')
                                <a href="{{ route('member.ebook.read', ['slug' => $ebooks->slug]) }}" class="buy btn btn-warning w-100">Mulai Belajar</a>
                            @else
                                <a href="{{ route('member.payment', ['ebook_id' => $ebooks->id]) }}" class="buy btn btn-warning w-100">Ambil Kelas</a>
                            @endif
                        @else
                            @if (in_array($ebooks->id, $InBundle))
                            <a href="" class="buy btn btn-warning w-100">Terdapat Paket Combo</a>
                            @else
                            <a href="{{ route('member.payment', ['ebook_id' => $ebooks->id]) }}" class="buy btn btn-warning w-100">Ambil Kelas</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <div class="card mb-3" data-aos="fade-up">
                <div class="card-body">
                    <h5>Detail Ebook</h5>
                    <table class="detail">
                        <tr>
                            <td>Tanggal rilis</td>
                            <td><span>: {{ $ebooks->created_at->format('d F Y') }}</span></td>
                        </tr>
                        <tr>
                            <td>Tanggal update</td>
                            <td><span>: {{ $ebooks->updated_at->format('d F Y') }}</span></td>
                        </tr>
                        <tr>
                            <td>Tingkatan</td>
                            <td><span>: {{ ucfirst($ebooks->level) }}</span></td>
                        </tr>
                        <tr>
                            <td>Jenis paket</td>
                            <td><span>: {{ $ebooks->type }}</span></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card mb-3" data-aos="fade-up">
                <div class="card-body">
                   <h5>Deskripsi Kursus</h5>
                   <p>{{ $ebooks->description }}</p>
                </div>
            </div>
            <div class="testimoni" id="testimoni" data-aos="fade-up">
                <div class="container-fluid">
                    @if ($reviews->isNotEmpty())
                    <h1>Testimoni</h1>
                    <div class="col-12 mt-4">
                        <div class="row card-testimoni d-none d-md-flex">
                            @foreach ($reviews as $index => $review)
                                <div class="col-12 col-md-6 testimoni-card review-item" data-index="{{ $index }}" style="{{ $index >= 2 ? 'display: none;' : '' }}">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="card-head d-flex align-items-center">
                                                <img src="{{ asset('storage/images/avatars/' . ($review->user->avatar ?? 'default-avatar.png')) }}" alt="User Avatar" class="avatar-img" style="border-radius: 50%">

                                                <div class="name ms-3">
                                                    <h5 class="card-title m-0 fw-bold">{{ $review->user->name }}</h5>
                                                    <p class="m-0">{{ $review->user->profession }}</p>
                                                </div>
                                            </div>
                                            <p class="card-text p-0 m-0 mt-2">{{ $review->note }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-container d-md-none">
                            <div class="swiper-wrapper">
                                @foreach ($reviews as $review)
                                    <div class="swiper-slide testimoni-card review-item">
                                        <div class="card mb-4">
                                            <div class="card-body">
                                                <div class="card-head d-flex align-items-center">
                                                    <img src="{{ asset('storage/images/avatars/' . ($review->user->avatar ?? 'default-avatar.png')) }}" alt="User Avatar" class="avatar-img" style="border-radius: 50%">

                                                    <div class="name ms-3">
                                                        <h5 class="card-title m-0 fw-bold">{{ $review->user->name }}</h5>
                                                        <p class="m-0">{{ $review->user->profession ?? 'Profession not specified' }}</p>
                                                    </div>
                                                </div>
                                                <p class="card-text p-0 m-0 mt-2">{{ $review->note }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="navtabs-more-testimoni d-flex justify-content-center mt-4 d-none d-md-flex">
                            <button class="btn btn-primary px-4 pt-2 pb-2" id="show-more-btn">
                                Lihat Lainnya
                            </button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

        </div>

        <!-- Kolom Kanan -->
        <div class="layout-kanan col-md-4 d-none d-md-block">
            <div class="card-buy card mb-3" style="position: sticky; top: 100px;">
                <div class="card-buy-body">
                    <p class="paket text-center mt-2 mb-0">Ebook</p>
                    <h3 class="card-title text-center mt-3" data-aos="zoom-out" data-aos-delay="100">Mulai Belajar Kursus Ini</h3>
                    <p class="text-center mx-3" data-aos="zoom-out" data-aos-delay="200">Belajar dimanapun dan kapanpun bersama kami, dan dapatkan akses kelas selamanya dengan bergabung di kursus ini</p>
                    <div class="benefit ms-3">
                        <ul class="check-active-group mt-3 list-unstyled">
                            <ul class="check-active-group mt-3 list-unstyled">
                                <li class="check-active d-flex align-items-center mt-2" data-aos="zoom-out" data-aos-delay="100">
                                    <img src="{{ asset('devacademy/member/img/check-active.png') }}" alt="Check">
                                    <p class="m-0 p-0 ms-2">Akses E-book selamanya</p>
                                </li>
                            </ul>
                        </ul>
                    </div>
                    <div class="p-0">
                        @if ($ebooks->price != 0)
                            <h3 class="price text-center">Rp{{ number_format($ebooks->price, 0, ',', '.') }}</h3>
                        @else
                            <h3 class="price text-center">Gratis</h3>
                        @endif

                        @if ($transaction)
                            @if ($transaction->status == 'pending')
                                <a href="#" class="buy btn btn-warning w-100">Dalam Proses Pembayaran</a>
                            @elseif ($transaction->status == 'success')
                                <a href="{{ route('member.ebook.read', ['slug' => $ebooks->slug]) }}" class="buy btn btn-warning w-100">Mulai Belajar</a>
                            @else
                                <a href="{{ route('member.payment', ['ebook_id' => $ebooks->id]) }}" class="buy btn btn-warning w-100">Ambil Kelas</a>
                            @endif
                        @else
                            @if (in_array($ebooks->id, $InBundle))
                            <a href="" class="buy btn btn-warning w-100">Terdapat Paket Combo</a>
                            @else
                            <a href="{{ route('member.payment', ['ebook_id' => $ebooks->id]) }}" class="buy btn btn-warning w-100">Ambil Kelas</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@push('addon-script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const showMoreBtn = document.getElementById('show-more-btn');
        let currentLimit = 4;

        showMoreBtn.addEventListener('click', function() {
            const reviews = document.querySelectorAll('.review-item');
            for (let i = currentLimit; i < currentLimit + 4 && i < reviews.length; i++) {
                reviews[i].style.display = 'block';
            }
            currentLimit += 4;
            if (currentLimit >= reviews.length) {
                showMoreBtn.style.display = 'none';
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let swiper;

        function initializeSwiper() {
            if (window.innerWidth < 768 && !swiper) {
                swiper = new Swiper('.swiper-container', {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                });
            } else if (window.innerWidth >= 768 && swiper) {
                swiper.destroy(true, true);
                swiper = undefined;
            }
        }
        initializeSwiper();
        window.addEventListener('resize', initializeSwiper);
    });
</script>



@endpush

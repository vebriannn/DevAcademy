@extends('components.layouts.member.app')

@section('title', 'Devacademy - Detail Kursus')

@push('prepend-style')
<link rel="stylesheet" href="{{ asset('devacademy/member/css/joincourse.css') }}">
@endpush

@section('content')
<main class="container-fluid mt-5 pt-5 pb-5 px-0">
    {{-- <div class="row">
        <!-- Kolom Kiri -->
        <div class="layout-kiri col-md-8">
            <h3 data-aos="fade-right" style="word-wrap: break-word; white-space: normal;">{{ $courses->name }}</h3>
            <div class="card-preview mb-3">
                @if ($courses->cover != null)
                <img src="{{ asset('storage/images/covers/' . $courses->cover) }}" alt="">
                @else
                <img src="{{ asset('devacademy/member/img/NemolabBG.jpg') }}" alt="">
                @endif
            </div>
            <div class="card mb-3 d-md-none">
                <div class="card-buy-body">
                    @if ($bundling)
                    <p class="paket text-center mt-2 mb-0">Paket Combo</p>
                    @else
                    <p class="paket text-center mt-2 mb-0">Kursus</p>
                    @endif
                    <h3 class="card-title text-center mt-3" data-aos="zoom-out" data-aos-delay="100">Mulai Belajar
                        Kursus Ini</h3>
                    <p class="text-center mx-3" data-aos="zoom-out" data-aos-delay="200">Belajar dimanapun dan kapanpun
                        bersama kami, dan dapatkan akses kelas selamanya dengan bergabung di kursus ini</p>
                    <div class="benefit ms-3">
                        <ul class="check-active-group mt-3 list-unstyled">
                            <ul class="check-active-group mt-3 list-unstyled">
                                <li class="check-active d-flex align-items-center mt-2" data-aos="zoom-out"
                                    data-aos-delay="100">
                                    <img src="{{ asset('devacademy/member/img/check-active.png') }}" alt="Check">
                                    <p class="m-0 p-0 ms-2">Akses kelas selamanya</p>
                                </li>
                                <li class="check-active d-flex align-items-center mt-2" data-aos="zoom-out"
                                    data-aos-delay="200">
                                    <img src="{{ asset('devacademy/member/img/check-active.png') }}" alt="Check">
                                    <p class="m-0 p-0 ms-2">Asset gratis</p>
                                </li>
                                <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                    data-aos-delay="300">
                                    <img src="{{ asset('devacademy/member/img/check-active.png') }}" alt="Check">
                                    <p class="m-0 p-0 ms-2">Belajar gratis</p>
                                </li>
                                @if ($bundling)
                                <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                    data-aos-delay="400">
                                    <img src="{{ asset('devacademy/member/img/check-active.png') }}" alt="Check">
                                    <p class="m-0 p-0 ms-2">Bonus E-Book</p>
                                </li>
                                @endif
                                <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                    data-aos-delay="500">
                                    <img src="{{ asset('devacademy/member/img/check-active.png') }}" alt="Check">
                                    <p class="m-0 p-0 ms-2">Sertifikat premium</p>
                                </li>
                                <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                    data-aos-delay="600">
                                    <img src="{{ asset('devacademy/member/img/check-active.png') }}" alt="Check">
                                    <p class="m-0 p-0 ms-2">Grup diskusi private</p>
                                </li>
                                <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                    data-aos-delay="700">
                                    <img src="{{ asset('devacademy/member/img/check-active.png') }}" alt="Check">
                                    <p class="m-0 p-0 ms-2">Konsultasi dengan mentor secara langsung</p>
                                </li>
                            </ul>
                        </ul>
                    </div>
                    <div class="p-0">
                        @if ($courses->price != 0 && !$bundling)
                        <h3 class="price text-center">Rp{{ number_format($courses->price, 0, ',', '.') }}</h3>
                        @elseif ($bundling && $bundling->price != 0)
                        <h3 class="price text-center">Rp{{ number_format($bundling->price, 0, ',', '.') }}</h3>
                        @else
                        <h3 class="price text-center">Gratis</h3>
                        @endif

                        @if ($transaction)
                        @if ($transaction->status == 'pending')
                        <a href="#" class="buy btn btn-warning w-100">Dalam Proses Pembayaran</a>
                        @elseif ($transaction->status == 'success')
                        @if (isset($lesson) && isset($lesson->episode))
                        <a href="{{ route('member.course.play', ['slug' => $courses->slug, 'episode' => $lesson->episode]) }}"
                            class="buy btn btn-warning w-100">Mulai Belajar</a>
                        @else
                        <a href="#" class="buy btn btn-warning w-100">Kelas Dalam Pembaruan</a>
                        @endif
                        @else
                        <a href="{{ route('member.payment', ['course_id' => $courses->id]) }}"
                            class="buy btn btn-warning w-100">Ambil Kelas</a>
                        @endif
                        @else
                        @if ($bundling)
                        <a href="{{ route('member.payment', ['bundle_id' => $bundling->id]) }}"
                            class="buy btn btn-warning w-100">Ambil Kelas</a>
                        @else
                        <a href="{{ route('member.payment', ['course_id' => $courses->id]) }}"
                            class="buy btn btn-warning w-100">Ambil Kelas</a>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
            @if ($bundling)
            <div class="card-bonus mb-3" data-aos="fade-up">
                <div class="card-bonus-body">
                    <h5>Bonus</h5>
                    <div class="d-flex">
                        <a class="book-img" href="{{ route('member.ebook.join', $bundling->ebook->slug) }}">
                            <img src="{{ asset('storage/images/covers/ebook/' . $bundling->ebook->cover) }}" alt=""
                                width="80" height="100" style="object-fit: cover; border-radius: 5px">
                        </a>
                        <table class="detail">
                            <tr>
                                <td>Judul E-Book</td>
                                <td><span>: {{ $bundling->ebook->name }}</span></td>
                            </tr>
                            <tr>
                                <td>Kategori E-Book</td>
                                <td><span>: {{ $bundling->ebook->category }}</span></td>
                            </tr>
                            <tr>
                                <td>Tingkatan</td>
                                <td><span>:
                                        @if ($bundling->ebook->level == 'beginner')
                                        Pemula
                                        @elseif ($bundling->ebook->level == 'intermediate')
                                        Menengah
                                        @else
                                        Ahli
                                        @endif</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            @endif

            <div class="card mb-3" data-aos="fade-up">
                <div class="card-body">
                    <h5>Detail Kursus</h5>
                    <table class="detail">
                        <tr>
                            <td>Tanggal rilis</td>
                            <td><span>: {{ $courses->created_at->format('d F Y') }}</span></td>
                        </tr>
                        <tr>
                            <td>Tanggal update</td>
                            <td><span>: {{ $courses->updated_at->format('d F Y') }}</span></td>
                        </tr>
                        <tr>
                            <td>Tingkatan</td>
                            <td>
                                <span>:
                                    @if ($courses->type == 'beginner')
                                    Pemula
                                    @elseif ($courses->type == 'intermediate')
                                    Menengah
                                    @else
                                    Ahli
                                    @endif
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>Jenis paket</td>
                            <td>
                                <span>:
                                    @if ($courses->type == 'free')
                                    Gratis
                                    @else
                                    Berbayar
                                    @endif
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="card mb-3" data-aos="fade-up">
                <div class="card-body">
                    <h5>Deskripsi Kursus</h5>
                    <p>{{ $courses->description }}</p>
                </div>
            </div>

            <div class="card mb-3" data-aos="fade-up">
                <div class="card-body">
                    <h5>Tools</h5>
                    <div class="d-flex">
                        @foreach ($coursetools->tools as $tool)
                        <div class="card-tool px-2 pt-2 me-3 mb-3">
                            <img src="{{ asset('storage/images/logoTools/' . $tool->logo_tools) }}" alt="" class=""
                                width="50" height="50">
                            <p>{{ $tool->name_tools }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="testimoni" id="testimoni" data-aos="fade-up">
                <div class="container-fluid">
                    @if ($reviews->isNotEmpty())
                    <h1>Testimoni</h1>
                    <div class="col-12 mt-4">
                        <div class="row card-testimoni d-none d-md-flex">
                            @foreach ($reviews as $index => $review)
                            <div class="col-12 col-md-6 testimoni-card review-item" data-index="{{ $index }}"
                                style="{{ $index >= 2 ? 'display: none;' : '' }}">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="card-head d-flex align-items-center">
                                            <img src="{{ asset('storage/images/avatars/' . ($review->user->avatar ?? 'default-avatar.png')) }}"
                                                alt="User Avatar" class="avatar-img" style="border-radius: 50%">

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
                                                <img src="{{ asset('storage/images/avatars/' . ($review->user->avatar ?? 'default-avatar.png')) }}"
                                                    alt="User Avatar" class="avatar-img" style="border-radius: 50%">

                                                <div class="name ms-3">
                                                    <h5 class="card-title m-0 fw-bold">{{ $review->user->name }}</h5>
                                                    <p class="m-0">{{ $review->user->profession ?? 'Profession not
                                                        specified' }}</p>
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
                    @if ($bundling)
                    <p class="paket text-center mt-2 mb-0">Paket Combo</p>
                    @else
                    <p class="paket text-center mt-2 mb-0">Kursus</p>
                    @endif
                    <h3 class="card-title text-center mt-3" data-aos="zoom-out" data-aos-delay="100">Mulai Belajar
                        Kursus Ini</h3>
                    <p class="text-center mx-3" data-aos="zoom-out" data-aos-delay="200">Belajar dimanapun dan kapanpun
                        bersama kami, dan dapatkan akses kelas selamanya dengan bergabung di kursus ini</p>
                    <div class="benefit ms-3">
                        <ul class="check-active-group mt-3 list-unstyled">
                            <ul class="check-active-group mt-3 list-unstyled">
                                <li class="check-active d-flex align-items-center mt-2" data-aos="zoom-out"
                                    data-aos-delay="100">
                                    <img src="{{ asset('devacademy/member/img/check-active.png') }}" alt="Check">
                                    <p class="m-0 p-0 ms-2">Akses kelas selamanya</p>
                                </li>
                                <li class="check-active d-flex align-items-center mt-2" data-aos="zoom-out"
                                    data-aos-delay="200">
                                    <img src="{{ asset('devacademy/member/img/check-active.png') }}" alt="Check">
                                    <p class="m-0 p-0 ms-2">Asset gratis</p>
                                </li>
                                <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                    data-aos-delay="300">
                                    <img src="{{ asset('devacademy/member/img/check-active.png') }}" alt="Check">
                                    <p class="m-0 p-0 ms-2">Belajar gratis</p>
                                </li>
                                @if ($bundling)
                                <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                    data-aos-delay="400">
                                    <img src="{{ asset('devacademy/member/img/check-active.png') }}" alt="Check">
                                    <p class="m-0 p-0 ms-2">Bonus E-Book</p>
                                </li>
                                @endif
                                <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                    data-aos-delay="500">
                                    <img src="{{ asset('devacademy/member/img/check-active.png') }}" alt="Check">
                                    <p class="m-0 p-0 ms-2">Sertifikat premium</p>
                                </li>
                                <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                    data-aos-delay="600">
                                    <img src="{{ asset('devacademy/member/img/check-active.png') }}" alt="Check">
                                    <p class="m-0 p-0 ms-2">Grup diskusi private</p>
                                </li>
                                <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                    data-aos-delay="700">
                                    <img src="{{ asset('devacademy/member/img/check-active.png') }}" alt="Check">
                                    <p class="m-0 p-0 ms-2">Konsultasi dengan mentor secara langsung</p>
                                </li>
                            </ul>
                        </ul>
                    </div>
                    <div class="p-0">
                        @if ($courses->price != 0 && !$bundling)
                        <h3 class="price text-center">Rp{{ number_format($courses->price, 0, ',', '.') }}</h3>
                        @elseif ($bundling && $bundling->price != 0)
                        <h3 class="price text-center">Rp{{ number_format($bundling->price, 0, ',', '.') }}</h3>
                        @else
                        <h3 class="price text-center">Gratis</h3>
                        @endif

                        @if ($transaction)
                        @if ($transaction->status == 'pending')
                        <a href="#" class="buy btn btn-warning w-100">Dalam Proses Pembayaran</a>
                        @elseif ($transaction->status == 'success')
                        @if (isset($lesson) && isset($lesson->episode))
                        <a href="{{ route('member.course.play', ['slug' => $courses->slug, 'episode' => $lesson->episode]) }}"
                            class="buy btn btn-warning w-100">Mulai Belajar</a>
                        @else
                        <a href="#" class="buy btn btn-warning w-100">Kelas Dalam Pembaruan</a>
                        @endif
                        @else
                        <a href="{{ route('member.payment', ['course_id' => $courses->id]) }}"
                            class="buy btn btn-warning w-100">Ambil Kelas</a>
                        @endif
                        @else
                        @if ($bundling)
                        <a href="{{ route('member.payment', ['bundle_id' => $bundling->id]) }}"
                            class="buy btn btn-warning w-100">Ambil Kelas</a>
                        @else
                        <a href="{{ route('member.payment', ['course_id' => $courses->id]) }}"
                            class="buy btn btn-warning w-100">Ambil Kelas</a>
                        @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="container px-0">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-tittle">
                    <h1 data-aos="fade-right" style="word-wrap: break-word; white-space: normal;">{{ $courses->name }}
                    </h1>
                    <h5 class="mt-3">Deskripsi Kursus</h5>
                    <p style="max-width: 90%;">{{ $courses->description }}</p>
                    <div class="keuntungan mt-3">
                        <h5>Keuntungan belajar kelas ini</h5>
                        <ul class="check-active-group mt-3 list-unstyled d-flex gap-4">
                            <!-- Changed to ul and added list-unstyled -->
                            <li class="check-active d-flex align-items-center" data-aos="zoom-out">
                                <img src="{{ asset('devacademy/member/img/icon/ph_check-bold.png') }}" alt="Check">
                                <p class="m-0 p-0 ms-2">Akses kelas selamanya</p>
                            </li>
                            <li class="check-active d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
                                <img src="{{ asset('devacademy/member/img/icon/ph_check-bold.png') }}" alt="Check">
                                <p class="m-0 p-0 ms-2">Asset Gratis</p>
                            </li>
                            <li class="check-active d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                                <img src="{{ asset('devacademy/member/img/icon/ph_check-bold.png') }}" alt="Check">
                                <p class="m-0 p-0 ms-2">Belajar Gratis</p>
                            </li>
                        </ul>
                    </div>
                    
                    @if ($courses->price != 0 && !$bundling)
                    <h4 class="price ">Rp{{ number_format($courses->price, 0, ',', '.') }}</h4>
                    @elseif ($bundling && $bundling->price != 0)
                    <h4 class="price ">Rp{{ number_format($bundling->price, 0, ',', '.') }}</h4>
                    @else
                    <h4 class="price ">Gratis</h4>
                    @endif


                    @if ($transaction)
                    @if ($transaction->status == 'pending')
                    <a href="#" class="buy btn btn-primary py-2 w-100">Dalam Proses Pembayaran</a>
                    @elseif ($transaction->status == 'success')
                    @if (isset($lesson) && isset($lesson->episode))
                    <a href="{{ route('member.course.play', ['slug' => $courses->slug, 'episode' => $lesson->episode]) }}"
                        class="buy btn btn-primary py-2 w-100">Mulai Belajar</a>
                    @else
                    <a href="#" class="buy btn btn-primary py-2 w-100">Kelas Dalam Pembaruan</a>
                    @endif
                    @else
                    <a href="{{ route('member.payment', ['course_id' => $courses->id]) }}"
                        class="buy btn btn-primary py-2 w-100">Ambil Kelas</a>
                    @endif
                    @else
                    @if ($bundling)
                    <a href="{{ route('member.payment', ['bundle_id' => $bundling->id]) }}"
                        class="buy btn btn-primary py-2 w-100">Ambil Kelas</a>
                    @else
                    <a href="{{ route('member.payment', ['course_id' => $courses->id]) }}"
                        class="buy btn btn-primary py-2 w-100">Ambil Kelas</a>
                    @endif
                    @endif
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-preview p-0">
                    @if ($courses->cover != null)
                    <img src="{{ asset('storage/images/covers/' . $courses->cover) }}" alt="">
                    @else
                    <img src="{{ asset('devacademy/member/img/NemolabBG.jpg') }}" alt="">
                    @endif
                </div>
            </div>
            <div class="col-md-8 mt-4">
                <div class="card card-materi">
                    <h5 class="text-black">Materi</h5>
                    <p class="text-black m-0">
                        Pada kelas ini kita akan mengerjakan studi kasus Aplikasi Mobile Kelas Online dalam mempelajari
                        seluruh elemen penting di dalam UI/UX Design.
                        Setelah mempelajari kelas ini, kamu akan dapat membuat:
                    <ul class="m-0">
                        <li>Design Thinking</li>
                        <li>User Flow</li>
                        <li>Wireframe</li>
                        <li>UI Style Guide</li>
                        <li>UI/UX Design</li>
                        <li>UI/UX Prototype</li>
                        <li>User Research Document</li>
                        <li>UX Case Study</li>
                    </ul>
                    Kamu juga akan dapat bergabung ke grup exclusive UI/UX Design Mastery Discord Server untuk bergabung
                    dengan sobat Skilvul lainnya dan dapat berkomunikasi serta bertanya langsung dengan mentor UI/UX
                    Design dari Skilvul
                    </p>
                </div>
            </div>
            <div class="col-md-4 mt-4">
                <div class="card card-detail">
                    <h5 class="text-black">Detail</h5>
                    <div class="d-flex">
                        <div class="head">
                            <ul class="p-0 m-0 d-flex flex-column gap-3">
                                <li>Tanggal rilis </li>
                                <li>Tanggal ulidate </li>
                                <li>Jenis Paket </li>
                                <li>Tingkatan</li>
                            </ul>
                        </div>
                        <div class="answer ms-4">
                            <ul class="m-0 d-flex flex-column gap-3">
                                <li>: 2 Oktober 2024</li>
                                <li>: -</li>
                                <li>: Kursus</li>
                                <li>: Pemula</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card .card-tools mt-2 d-flex ">
                    <h5>Tools</h5>
                    {{-- <div class="container-tools d-flex gap-3">
                        <div class="tools d-flex mt-3  align-items-center justify-content-center">
                            @foreach ($coursetools->tools as $tool)
                            <div
                                class="card-tool py-3 px-3 d-flex flex-column align-items-center justify-content-center">
                                <img src="{{ asset('storage/images/logoTools/' . $tool->logo_tools) }}" alt="" class=""
                                    width="50" height="50">
                                <p class="mb-0 mt-2 align-middle text-center">{{ $tool->name_tools }}</p>
                            </div>
                            @endforeach
                        </div> --}}
                        <div class="container-tools d-flex gap-3">
                            <div class="tools d-flex mt-3">
                                @foreach ($coursetools->tools as $tool)
                                <div class="card-tool d-flex flex-column align-items-center ">
                                    <img src="{{ asset('storage/images/logoTools/' . $tool->logo_tools) }}" alt=""
                                        class="tool-image mt-3">
                                    <p class="tool-text mt-2 text-center">Figma</p>
                                </div>
                                @endforeach
                            </div>
                            <div class="container-tools d-flex gap-3">
                                <div class="tools d-flex mt-3">
                                    @foreach ($coursetools->tools as $tool)
                                    <div class="card-tool d-flex flex-column align-items-center ">
                                        <img src="{{ asset('storage/images/logoTools/' . $tool->logo_tools) }}" alt=""
                                            class="tool-image mt-3  ">
                                        <p class="tool-text mt-2 text-center">Visual Studio Code</p>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <section class="section-testimoni-kelas mt-5 me-0 px-0" id="section-testimoni-kelas" data-aos="fade-up">
        <div class="container">
            <div class="testimoni-title pb-5 col-8">
                <h1 data-aos="fade-right">Testimoni</h1>
            </div>
        </div>
        <div class="container-fluid row p-0 m-0">
            <div class="row  p-0" id="testimonials">
                <div class="col-md-12 p-0 carousel-container">
                    <div class="carousel-track d-flex" style="margin-left: -500px">
                        <div class="col-xl-2 col-md-3 col-sm-3 carousel-run ms-3 d-flex justify-content-center">
                            <div class="card mb-4">
                                <div class="card-body row">
                                    <div class="col-md-2">
                                        <div class="rounded-circle icon-testi d-flex justify-content-center align-items-center">
                                            <img class="mx-auto" src="{{ asset('devacademy/member/img/icon/icon-testimonial.png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <p class="card-text p-0 m-0">Kelas UI/UX ini memberi saya wawasan baru tentang cara
                                            memahami kebutuhan pengguna. Sempurna untuk meningkatkan skill desainmu!</p>
                                            <hr>
                                        <div class="card-head d-flex align-items-center">
                                            <img src="{{ asset('devacademy/member/img/dumy-1.jpg') }}" width="45"
                                                    height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                             <div class="name ms-3">
                                                <h5 class="card-title m-0 fw-bold">Rahmat Hidayat Sianturi</h5>
                                                <p class="m-0">UI/UX Designer</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-3 col-sm-3 carousel-run ms-3 d-flex justify-content-center">
                            <div class="card mb-4">
                                <div class="card-body row">
                                    <div class="col-md-2">
                                        <div class="rounded-circle icon-testi d-flex justify-content-center align-items-center">
                                            <img class="mx-auto" src="{{ asset('devacademy/member/img/icon/icon-testimonial.png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <p class="card-text p-0 m-0">Kelas UI/UX ini memberi saya wawasan baru tentang cara
                                            memahami kebutuhan pengguna. Sempurna untuk meningkatkan skill desainmu!</p>
                                            <hr>
                                        <div class="card-head d-flex align-items-center">
                                            <img src="{{ asset('devacademy/member/img/dumy-1.jpg') }}" width="45"
                                                    height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                             <div class="name ms-3">
                                                <h5 class="card-title m-0 fw-bold">Rahmat Hidayat Sianturi</h5>
                                                <p class="m-0">UI/UX Designer</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-3 col-sm-3 carousel-run ms-3 d-flex justify-content-center">
                            <div class="card mb-4">
                                <div class="card-body row">
                                    <div class="col-md-2">
                                        <div class="rounded-circle icon-testi d-flex justify-content-center align-items-center">
                                            <img class="mx-auto" src="{{ asset('devacademy/member/img/icon/icon-testimonial.png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <p class="card-text p-0 m-0">Kelas UI/UX ini memberi saya wawasan baru tentang cara
                                            memahami kebutuhan pengguna. Sempurna untuk meningkatkan skill desainmu!</p>
                                            <hr>
                                        <div class="card-head d-flex align-items-center">
                                            <img src="{{ asset('devacademy/member/img/dumy-1.jpg') }}" width="45"
                                                    height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                             <div class="name ms-3">
                                                <h5 class="card-title m-0 fw-bold">Rahmat Hidayat Sianturi</h5>
                                                <p class="m-0">UI/UX Designer</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Duplicate Cards for Infinite Effect -->
                        <div class="col-xl-2 col-md-3 col-sm-3 carousel-run ms-3 d-flex justify-content-center">
                            <div class="card mb-4">
                                <div class="card-body row">
                                    <div class="col-md-2">
                                        <div class="rounded-circle icon-testi d-flex justify-content-center align-items-center">
                                            <img class="mx-auto" src="{{ asset('devacademy/member/img/icon/icon-testimonial.png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <p class="card-text p-0 m-0">Kelas UI/UX ini memberi saya wawasan baru tentang cara
                                            memahami kebutuhan pengguna. Sempurna untuk meningkatkan skill desainmu!</p>
                                            <hr>
                                        <div class="card-head d-flex align-items-center">
                                            <img src="{{ asset('devacademy/member/img/dumy-1.jpg') }}" width="45"
                                                    height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                             <div class="name ms-3">
                                                <h5 class="card-title m-0 fw-bold">Rahmat Hidayat Sianturi</h5>
                                                <p class="m-0">UI/UX Designer</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-3 col-sm-3 carousel-run ms-3 d-flex justify-content-center">
                            <div class="card mb-4">
                                <div class="card-body row">
                                    <div class="col-md-2">
                                        <div class="rounded-circle icon-testi d-flex justify-content-center align-items-center">
                                            <img class="mx-auto" src="{{ asset('devacademy/member/img/icon/icon-testimonial.png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <p class="card-text p-0 m-0">Kelas UI/UX ini memberi saya wawasan baru tentang cara
                                            memahami kebutuhan pengguna. Sempurna untuk meningkatkan skill desainmu!</p>
                                            <hr>
                                        <div class="card-head d-flex align-items-center">
                                            <img src="{{ asset('devacademy/member/img/dumy-1.jpg') }}" width="45"
                                                    height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                             <div class="name ms-3">
                                                <h5 class="card-title m-0 fw-bold">Rahmat Hidayat Sianturi</h5>
                                                <p class="m-0">UI/UX Designer</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-md-3 col-sm-3 carousel-run ms-3 d-flex justify-content-center">
                            <div class="card mb-4">
                                <div class="card-body row">
                                    <div class="col-md-2">
                                        <div class="rounded-circle icon-testi d-flex justify-content-center align-items-center">
                                            <img class="mx-auto" src="{{ asset('devacademy/member/img/icon/icon-testimonial.png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <p class="card-text p-0 m-0">Kelas UI/UX ini memberi saya wawasan baru tentang cara
                                            memahami kebutuhan pengguna. Sempurna untuk meningkatkan skill desainmu!</p>
                                            <hr>
                                        <div class="card-head d-flex align-items-center">
                                            <img src="{{ asset('devacademy/member/img/dumy-1.jpg') }}" width="45"
                                                    height="45" style="border-radius: 50%;object-fit:cover" alt="">
                                             <div class="name ms-3">
                                                <h5 class="card-title m-0 fw-bold">Rahmat Hidayat Sianturi</h5>
                                                <p class="m-0">UI/UX Designer</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
                
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
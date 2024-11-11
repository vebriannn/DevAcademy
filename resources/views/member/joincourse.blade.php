@extends('components.layouts.member.app')

@section('title', 'Nemolab - Detail Kursus')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/joincourse.css') }}">
@endpush

@section('content')
    <main class="container mt-5 pt-5 pb-5">
        <div class="row">
            <!-- Kolom Kiri -->
            <div class="layout-kiri col-md-8">
                <h3 data-aos="fade-right">{{ $courses->name }}</h3>
                <div class="card-preview mb-3">
                    <img src="{{ asset('storage/images/covers/' . $courses->cover) }}" alt="">
                </div>
                <div class="card mb-3 d-md-none">
                    <div class="card-buy-body">
                        <p class="paket text-center mt-2 mb-0">Kursus</p>
                        <h3 class="card-title text-center mt-3" data-aos="zoom-out" data-aos-delay="100">Mulai Belajar
                            Kursus Ini</h3>
                        <p class="text-center mx-3" data-aos="zoom-out" data-aos-delay="200">Belajar dimanapun dan kapanpun
                            bersama kami, dan dapatkan akses kelas selamanya dengan bergabung di kursus ini</p>
                        <div class="benefit ms-3">
                            <ul class="check-active-group mt-3 list-unstyled">
                                <ul class="check-active-group mt-3 list-unstyled">
                                    <li class="check-active d-flex align-items-center mt-2" data-aos="zoom-out"
                                        data-aos-delay="100">
                                        <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                        <p class="m-0 p-0 ms-2">Akses kelas selamanya</p>
                                    </li>
                                    <li class="check-active d-flex align-items-center mt-2" data-aos="zoom-out"
                                        data-aos-delay="200">
                                        <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                        <p class="m-0 p-0 ms-2">Asset gratis</p>
                                    </li>
                                    <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                        data-aos-delay="300">
                                        <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                        <p class="m-0 p-0 ms-2">Belajar gratis</p>
                                    </li>
                                    <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                        data-aos-delay="400">
                                        <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                        <p class="m-0 p-0 ms-2">Bonus E-Book</p>
                                    </li>
                                    <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                        data-aos-delay="500">
                                        <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                        <p class="m-0 p-0 ms-2">Sertifikat premium</p>
                                    </li>
                                    <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                        data-aos-delay="600">
                                        <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                        <p class="m-0 p-0 ms-2">Grup diskusi private</p>
                                    </li>
                                    <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                        data-aos-delay="700">
                                        <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                        <p class="m-0 p-0 ms-2">Konsultasi dengan mentor secara langsung</p>
                                    </li>
                                </ul>>
                            </ul>
                        </div>
                        <div class="p-0">
                            @if ($courses->price != 0)
                                <h3 class="price text-center">Rp{{ number_format($courses->price, 0, ',', '.') }}</h3>
                            @else
                                <h3 class="price text-center">Gratis</h3>
                            @endif
                            <a href="{{ route('member.payment', ['course_id' => $courses->id]) }}"
                                class="buy btn btn-warning w-100">Ambil Kelas</a>
                        </div>
                    </div>
                </div>

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
                                    <img src="{{ asset('storage/images/logoTools/' . $tool->logo_tools) }}" alt=""
                                        class="">
                                    <p>{{ $tool->name_tools }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

            <!-- Kolom Kanan -->
            <div class="layout-kanan col-md-4 d-none d-md-block">
                <div class="card-buy card mb-3" style="position: sticky; top: 100px;">
                    <div class="card-buy-body">
                        <p class="paket text-center mt-2 mb-0">Kursus</p>
                        <h3 class="card-title text-center mt-3" data-aos="zoom-out" data-aos-delay="100">Mulai Belajar
                            Kursus Ini</h3>
                        <p class="text-center mx-3" data-aos="zoom-out" data-aos-delay="200">Belajar dimanapun dan kapanpun
                            bersama kami, dan dapatkan akses kelas selamanya dengan bergabung di kursus ini</p>
                        <div class="benefit ms-3">
                            <ul class="check-active-group mt-3 list-unstyled">
                                <ul class="check-active-group mt-3 list-unstyled">
                                    <li class="check-active d-flex align-items-center mt-2" data-aos="zoom-out"
                                        data-aos-delay="100">
                                        <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                        <p class="m-0 p-0 ms-2">Akses kelas selamanya</p>
                                    </li>
                                    <li class="check-active d-flex align-items-center mt-2" data-aos="zoom-out"
                                        data-aos-delay="200">
                                        <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                        <p class="m-0 p-0 ms-2">Asset gratis</p>
                                    </li>
                                    <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                        data-aos-delay="300">
                                        <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                        <p class="m-0 p-0 ms-2">Belajar gratis</p>
                                    </li>
                                    <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                        data-aos-delay="400">
                                        <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                        <p class="m-0 p-0 ms-2">Bonus E-Book</p>
                                    </li>
                                    <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                        data-aos-delay="500">
                                        <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                        <p class="m-0 p-0 ms-2">Sertifikat premium</p>
                                    </li>
                                    <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                        data-aos-delay="600">
                                        <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                        <p class="m-0 p-0 ms-2">Grup diskusi private</p>
                                    </li>
                                    <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out"
                                        data-aos-delay="700">
                                        <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                                        <p class="m-0 p-0 ms-2">Konsultasi dengan mentor secara langsung</p>
                                    </li>
                                </ul>
                            </ul>
                        </div>
                        <div class="p-0">
                            @if ($courses->price != 0)
                                <h3 class="price text-center">Rp{{ number_format($courses->price, 0, ',', '.') }}</h3>
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
                                <a href="{{ route('member.payment', ['course_id' => $courses->id]) }}"
                                    class="buy btn btn-warning w-100">Ambil Kelas</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

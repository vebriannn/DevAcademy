@extends('components.layouts.member.navback')

@section('title', 'Join Kelas')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/joincourse.css') }} ">
@endpush

@section('content')
    <!-- Header -->
    <div class="container mb-4" style="margin-top: 4rem">
        <div class="row">
            <div class="col-12 text-center justify-content-center">
                <h4 class="fw-semibold">{{ $course->name }}</h4>
                <div class="d-flex align-items-center justify-content-center flex-md-row flex-column" style="margin-top: -6px; font-size: 15px">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('nemolab/member/img/global.png') }}" alt="" width="18" height="18" class="m-0" />
                    <p class="m-0 ms-2 fw-light" style="font-size: 14px">Release Date{{ $course->created_at->format('d F Y') }} </p>
                </div>
                <div class="rating d-flex ms-1 my-1 my-0 align-items-center">
                    <p class="m-0 ms-0 ms-md-5 me-2 fw-medium" style="font-size: 14px">4.9</p>
                    <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19"/>
                    <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19"/>
                    <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19"/>
                    <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19"/>
                    <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19"/>
                </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 p-lg-0 pe-lg-2">
                <img src="{{ asset('storage/images/covers/' . $course->cover) }}" alt="" width="100%"
                    class="rounded-4" style="max-height: 25rem; object-fit: cover" />
            </div>
            <div class="col-lg-4 mx-auto col-11 p-4 mt-4 mt-lg-0 border border-2 rounded-4 position-relative overflow-hidden shadow-sm"
                style="height: 25rem">
                @if ($chapters->isNotEmpty())
                    <p class="fw-bold">{{ $chapters->count() }} Chapter</p>
                    <div class="playlist">
                        @foreach ($chapters as $chapter)
                            <div class="play">
                                <div class="title d-flex">
                                    <img src="{{ asset('nemolab/member/img/play.png') }}" alt="" width="25"
                                        height="25" />
                                    <p class="ms-3 m-0">{{ $chapter->name }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if ($transaction && $transaction->status == 'pending')
                        <div class="alert alert-warning mt-3" role="alert">
                            Pembayaran anda sedang diproses.
                        </div>
                    @elseif ($transaction && $transaction->status == 'success')
                        <a href="{{ route('member.course.play', ['slug' => $course->slug, 'episode' => $lesson->episode]) }}">
                            <div class="button">Start Learning</div>
                        </a>
                    @else
                        <a href="{{ route('member.payment', ['course_id' => $course->id]) }}">
                            <div class="button">Start Learning</div>
                        </a>
                    
                    @endif
                @else
                    <p class="fw-bold">0 Chapter</p>
                @endif
            </div>
        </div>
        <!-- About -->
        <div class="row my-5">
            <div class="col-12">
                <h4 class="fw-semibold">About</h4>
                <p class="mt-4" style="font-size: 14px">
                    {{ $course->description }}
                </p>
            </div>
            <div class="col-12 mt-4">
                <h4 class="fw-semibold">eBook</h4>
                <p class="mt-4" style="font-size: 14px">
                    eBook adalah buku elektronik yang memungkinkan Anda untuk membaca dan belajar kapan saja dan di mana saja melalui perangkat digital Anda. Dengan format yang fleksibel, eBook menawarkan cara baru yang praktis untuk mengakses
            informasi dan konten pendidikan.eBook adalah buku elektronik yang memungkinkan Anda untuk membaca dan belajar kapan saja dan di mana saja melalui perangkat digital Anda. Dengan format yang fleksibel, eBook menawarkan cara baru
            yang praktis untuk mengakses informasi dan konten pendidikan.eBook adalah buku elektronik yang memungkinkan Anda untuk membaca dan belajar kapan saja dan di mana saja melalui perangkat digital Anda. Dengan format yang fleksibel,
            eBook menawarkan cara baru yang praktis untuk mengakses informasi dan konten pendidikan.
                </p>
                <a href=""><button class="btn px-4 py-2 fw-medium text-white">Start Learing</button></a>
            </div>
        </div>
         <!-- Tools -->
        {{-- <div class="row">
            <div class="col-12">
            <h4 class="fw-semibold mb-4">Tools</h4>
            </div>
            <div class="col-lg-3 col-md-6 my-2 my-sm-2">
            <div class="tools p-4 border border-2 rounded-4 shadow-sm">
                <div class="d-flex align-items-center d-md-block">
                <div class="col-6 text-center text-md-start">
                    <img src="{{ asset('nemolab/member/img/xd.png') }}" alt="" width="70" />
                </div>
                <div class="col-6 col-md-12">
                    <!-- ini -->
                    <p class="fw-semibold mt-0 mt-md-4">
                    Adobe XD <br />
                    Software Gratis
                    </p>
                    <button class="btn rounded-5 mt-md-4 px-3 py-2 text-white fw-semibold btn-text">Download Now</button>
                </div>
                </div>
            </div>
            </div>

            <div class="col-lg-3 col-md-6 my-2 my-sm-2">
            <div class="tools p-4 border border-2 rounded-4 shadow-sm">
                <div class="d-flex align-items-center d-md-block">
                <div class="col-6 text-center text-md-start">
                    <img src="{{ asset('nemolab/member/img/adobe.png') }}" alt="" width="70" />
                </div>
                <div class="col-6 col-md-12">
                    <p class="fw-semibold mt-0 mt-md-4">
                    Adobe Premier <br />
                    Software Gratis
                    </p>
                    <button class="btn rounded-5 mt-md-4 px-3 py-2 text-white fw-semibold btn-text">Download Now</button>
                </div>
                </div>
            </div>
            </div>
        </div> --}}
        <!-- Payment -->
        @if (!isset($transaction) || ($transaction && $transaction->status == 'failed'))
        <div class="row my-5">
            <div class="col-12">
                <h4 class="fw-semibold">Payment</h4>
            </div>
            <div class="d-flex justify-content-md-between w-100" style="flex-wrap: wrap">
                <div class="col-custom col-12 border border-2 rounded-4 p-4 ms-lg-2 mt-4 shadow-sm">
                    <img src="{{ asset('nemolab/member/img/payment-img.png') }}" alt="" width="70" />
                    <p class="mt-4 fw-light mb-1" style="font-size: 15px">Video</p>
                    <h5 class="fw-semibold">Rp {{ number_format($course->price, 0) }}</h5>
                    <p>Raih Akses Premium Seumur Hidup dan Bangun Proyek Nyata Anda Sendiri</p>
                    <hr class="mb-4 border-2" />
                    <div>
                        <div class="profit">
                            <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25"
                                height="25" />
                            <p>Akses Eksklusif Seumur Hidup</p>
                        </div>
                        <div class="profit">
                            <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25"
                                height="25" />
                            <p>Raih Premium Istimewa</p>
                        </div>
                        <div class="profit">
                            <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25"
                                height="25" />
                            <p>Konsultasi Karier Pribadi</p>
                        </div>
                        <div class="profit">
                            <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25"
                                height="25" />
                            <p>Sertifikat Kelulusan Prestisius</p>
                        </div>
                        <div class="profit">
                            <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25"
                                height="25" />
                            <p>Kesempatan Karier Bergengsi</p>
                        </div>
                    </div>
                    <a href="{{ route('member.payment', ['course_id' => $course->id]) }}" class="text-decoration-none">
                        <button class="btn mx-auto d-flex px-5 py-2 mt-3 text-white fw-semibold rounded-3">Beli Kelas</button>
                    </a>
                </div>
                <div class="col-custom col-12 border border-2 rounded-4 p-4 ms-lg-2 mt-4 shadow-sm">
                    <img src="{{ asset('nemolab/member/img/payment-img.png') }}" alt="" width="70" />
                    <p class="mt-4 fw-light mb-1" style="font-size: 15px">eBook</p>
                    <h5 class="fw-semibold">Rp {{ number_format($course->price, 0) }}</h5>
                    <p>Raih Akses Premium Seumur Hidup dan Bangun Proyek Nyata Anda Sendiri</p>
                    <hr class="mb-4 border-2" />
                    <div>
                        <div class="profit">
                            <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25"
                                height="25" />
                            <p>Akses Eksklusif Seumur Hidup</p>
                        </div>
                        <div class="profit">
                            <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25"
                                height="25" />
                            <p>Raih Premium Istimewa</p>
                        </div>
                        <div class="profit">
                            <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25"
                                height="25" />
                            <p>Konsultasi Karier Pribadi</p>
                        </div>
                        <div class="profit">
                            <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25"
                                height="25" />
                            <p>Sertifikat Kelulusan Prestisius</p>
                        </div>
                        <div class="profit">
                            <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25"
                                height="25" />
                            <p>Kesempatan Karier Bergengsi</p>
                        </div>
                    </div>
                    <a href="{{ route('member.payment', ['course_id' => $course->id]) }}" class="text-decoration-none">
                        <button class="btn mx-auto d-flex px-5 py-2 mt-3 text-white fw-semibold rounded-3">Beli Kelas</button>
                    </a>
                </div>
                <div class="col-custom col-12 border border-2 rounded-4 p-4 ms-lg-2 mt-4 shadow-sm">
                    <img src="{{ asset('nemolab/member/img/payment-img.png') }}" alt="" width="70" />
                    <p class="mt-4 fw-light mb-1" style="font-size: 15px">Video & eBook</p>
                    <h5 class="fw-semibold">Rp {{ number_format($course->price, 0) }}</h5>
                    <p>Raih Akses Premium Seumur Hidup dan Bangun Proyek Nyata Anda Sendiri</p>
                    <hr class="mb-4 border-2" />
                    <div>
                        <div class="profit">
                            <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25"
                                height="25" />
                            <p>Akses Eksklusif Seumur Hidup</p>
                        </div>
                        <div class="profit">
                            <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25"
                                height="25" />
                            <p>Raih Premium Istimewa</p>
                        </div>
                        <div class="profit">
                            <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25"
                                height="25" />
                            <p>Konsultasi Karier Pribadi</p>
                        </div>
                        <div class="profit">
                            <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25"
                                height="25" />
                            <p>Sertifikat Kelulusan Prestisius</p>
                        </div>
                        <div class="profit">
                            <img src="{{ asset('nemolab/member/img/check.png') }}" alt="" width="25"
                                height="25" />
                            <p>Kesempatan Karier Bergengsi</p>
                        </div>
                    </div>
                    <a href="{{ route('member.payment', ['course_id' => $course->id]) }}" class="text-decoration-none">
                        <button class="btn mx-auto d-flex px-5 py-2 mt-3 text-white fw-semibold rounded-3">Beli Kelas</button>
                    </a>
                </div>
                
            </div>
        </div>
        @endif
    </div>
@endsection

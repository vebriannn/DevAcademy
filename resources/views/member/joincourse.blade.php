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
                <div class="d-flex align-items-center justify-content-center" style="margin-top: -6px; font-size: 15px">
                    <p class="m-0 ms-2 fw-light" style="font-size: 14px">Release Date
                        {{ $course->created_at->format('d F Y') }} </p>
                    <p class="m-0 ms-5 fw-medium" style="font-size: 14px">4.9</p>
                    <div class="ms-1 mb-1">
                        <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" />
                        <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" />
                        <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" />
                        <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" />
                        <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" />
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
        </div>
        <!-- Payment -->
        @if (!isset($transaction) || ($transaction && $transaction->status == 'failed'))
        <div class="row my-5">
            <div class="col-12">
                <h4 class="fw-semibold">Payment</h4>
            </div>
            <div class="col-lg-4 col-md-6 border border-2 rounded-4 p-4 ms-lg-2 mt-4 shadow-sm">
                <img src="{{ asset('nemolab/member/img/payment-img.png') }}" alt="" width="70" />
                <h5 class="mt-4 fw-semibold">Rp {{ number_format($course->price, 0) }}</h5>
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
        @endif
    </div>
@endsection

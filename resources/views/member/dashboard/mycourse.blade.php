@extends('components.layouts.member.dashboard')

@section('title', 'My Course')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/dashboard/mycourse.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/sidebar.css') }} ">
@endpush

@section('content')

    <div class="container" style="margin-top: 5rem;">
        @if (!$submission && $total_course > 5)
            <div class="alert alert-warning alert-dismissible fade show text-black position-fixed fixed-top" role="alert">
                Ingin jadi Mentor? klik
                <form action="{{ route('member.pengajuan', Auth::user()->id) }}" method="post">
                    @csrf
                    <button type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        class="disini text-black px-2 py-1" style="text-decoration: underline !important">Disini
                    </button>
                </form>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            <!-- Sidebar -->
            <div class="col-3 d-none d-xl-block p-4 pb-5 rounded-4 text-white px-5 flex-wrap"
                style="background-color: #faa907;">
                <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}" style="border-radius: 100%;"
                    alt="" width="70" height="70" class="d-flex mx-lg-auto mt-3" />
                <h4 class="m-0 mt-lg-5 mt-3 fw-semibold">{{ Auth::user()->name }}</h4>
                <p class="m-0 fw-light">Status {{ Auth::user()->role }}</p>
                <div class="mt-5">
                    <a href="#" class="list-sidebar active">
                        <img src="{{ asset('nemolab/member/img/course active.png') }}" alt="" width="30" />
                        <p class="m-0">My Courses</p>
                    </a>
                    <a href="{{ route('member.portofolio') }}" class="list-sidebar">
                        <img src="{{ asset('nemolab/member/img/portofolio.png') }}" alt="" width="30" />
                        <p class="m-0">My Portofolio</p>
                    </a>
                    <a href="{{ route('member.transaction') }}" class="list-sidebar">
                        <img src="{{ asset('nemolab/member/img/transaksi.png') }}" alt="" width="30" />
                        <p class="m-0">Transactions</p>
                    </a>
                </div>
            </div>
            <!-- End Sidebar -->

            <!-- Content -->
            <div class="col-lg-9 col-md-12 ps-5">
                <h3 class="fw-bold tittle">My Courses</h3>
                <div class="course row row-course mt-3 w-100">
                    @foreach ($courses as $course)
                        @if ($course->transactions->isNotEmpty())
                            <div class="col-lg-4 col-sm-6 col-course mt-1 mb-2">
                                <div class="card-course h-100 d-flex flex-column">
                                    <div class="img-card">
                                        <img src="{{ asset('storage/images/covers/' . $course->cover) }}" alt="">
                                    </div>
                                    <div class="deskripsi px-3 ">
                                        <div class="category">
                                            <p class="m-0">{{ $course->category }}</p>
                                        </div>
                                        <div class="tittle-card fw-semibold">
                                            {{ $course->name }}
                                        </div>
                                        <div class="profile-card mt-2">
                                            <a href="">
                                                <img class="me-2"
                                                    src="{{ asset('storage/images/avatars/' . $course->users->avatar) }}"
                                                    alt="" width="30" style="border-radius: 100%" />
                                                {{ $course->users->name }}
                                            </a>
                                        </div>
                                        <div class="status d-flex mt-3">
                                            <div class="d-flex flex-direction-costum">
                                                <p class="txt-start">Sudah Di Bayar</p>
                                            </div>
                                            <img class="ms-auto me-0 "
                                                src="{{ asset('nemolab/member/img/check-mycourse.png') }}" alt=""
                                                width="30" height="30">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    
@endsection
@push('addon-script')
    <script>
        var message = document.querySelectorAll('#message');
        for (let index = 1; index < message.length; index++) {
            message[index].remove();
        }
    </script>
@endpush

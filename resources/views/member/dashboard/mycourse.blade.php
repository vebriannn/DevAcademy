@extends('components.layouts.member.dashboard')

@section('title', 'Nemolab - Lihat informasi dan perkembangan anda disini')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/sidebar-dashboard.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/course.css') }} ">
    @endpush
@section('content')

@if (Auth::user()->role == 'students')
@if (!$submission && $total_course >= 5)
    <div class="alert alert-warning alert-dismissible fade show text-black position-fixed fixed-top d-flex justify-center align-items-center"
        role="alert">
        Ingin jadi Mentor? klik
        <form action="{{ route('member.pengajuan', Auth::user()->id) }}" method="post">
            @csrf
            <button type="submit" data-bs-toggle="modal" data-bs-target="#exampleModal"
                class="disini text-black ps-1 btn p-0 m-0 shadow-none"
                style="text-decoration: underline !important">Disini
            </button>
        </form>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@endif
<section class="section-pilh-kelas" id="section-pilih-kelas">
        <div class="container-fluid mt-5 pt-5">
            <div class="row">
                @include('components.includes.member.sidebar-dashboard')
                <!-- Cards -->
                <div class="card-container col-md-9 pe-4" id="course-card">
                    <div>
                        <h3 class="fw-bold">Kelas Saya</h3>
                    </div>
                    <div class="row">
                    @foreach ($courses as $course)
                        @if ($course->transactions->isNotEmpty())
                            <a href="{{ route('member.course.join', $course->slug) }}" class="col-md-4 d-flex justify-content-center pb-3 text-decoration-none">
                                <div class="card">
                                    <img src="{{ asset('storage/images/covers/' . $course->cover) }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <div class="title-card">
                                            <h5 class="fw-bold truncate-text">{{ $course->name }}</h5>
                                            <p class="tipe">{{ $course->type }}</p>
                                        </div>
                                        <div class="btn-group-harga d-flex justify-content-between align-items-center mt-3">
                                            <div class="harga d-block">
                                                <p class="p-0 m-0 fw-semibold">Status</p>
                                                <p class="p-0 m-0 fw-semibold">Belum Selesai</p>
                                            </div>
                                            <div class="harga d-block">
                                                <p class="p-0 m-0 fw-semibold">Bergabung : </p>
                                                <p class="p-0 m-0 fw-semibold">{{ $course-> created_at->format('d F Y')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endforeach

                    {{-- @foreach ($ebooks as $ebook)
                        @if ($course->transactions->isNotEmpty())
                            <a href="{{ route('member.ebook.join', $ebook->slug) }}" class="col-md-4 d-flex justify-content-center pb-3 text-decoration-none">
                                <div class="card">
                                    <img src="{{ asset('storage/images/covers/ebook/' . $ebook->cover) }}" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <div class="title-card">
                                            <h5 class="fw-bold truncate-text">{{ $ebook->name }}</h5>
                                            <p class="tipe">{{ $ebook->type }}</p>
                                        </div>
                                        <div class="btn-group-harga d-flex justify-content-between align-items-center mt-3">
                                            <div class="harga d-block">
                                                <p class="p-0 m-0 fw-semibold">Status</p>
                                                <p class="p-0 m-0 fw-semibold">Belum Selesai</p>
                                            </div>
                                            <div class="harga d-block">
                                                <p class="p-0 m-0 fw-semibold">Bergabung : </p>
                                                <p class="p-0 m-0 fw-semibold">{{ $ebook-> created_at->format('d F Y')}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endforeach --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('components.includes.member.sidebar-dashboard-mobile')
@endsection
@push('addon-script')
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
                        object.stop(false, false).animate({ top: stopPoint - originalY }, 50);
                    } else {
                        object.stop(false, false).animate({ top: newTop }, 50);
                    }
                } else {
                    let newTop = scrollTop < originalY ? 0 : Math.min(sectionContainer.height() - object.height() - 52, scrollTop - originalY + topMargin);
                    if (scrollTop + sidebarHeight + topMargin >= footerTop) {
                        object.stop(true, true).animate({ top: stopPoint - originalY }, 50);
                    } else {
                        object.stop(true, true).animate({ top: newTop }, 50);
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

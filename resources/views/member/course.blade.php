@extends('components.layouts.member.app')

@section('title', 'Nemolab - Pilih Kursus Yang Ingin Anda Pelajari')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/sidebar-filter.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/course.css') }} ">
    @endpush

@section('content')
    <!-- CONTENT -->
    <section class="section-pilh-kelas" id="section-pilih-kelas">
        <div class="container-fluid mt-5 pt-5">
            <div class="row">
                <div class="col-12 mb-5 d-lg-none">
                    <h3 class="fw-bold">Pilihan Kelas</h3>
                    <div class="filter-menu d-flex justify-content-between align-items-center">
                        <form action="{{ route('member.course') }}" method="GET" class="d-flex">
                            <div class="row">
                                <div class="search">
                                    <input type="text" name="search-input" class="searchTerm" placeholder="Cari Kelas Disini" id="search-input" value="{{ request('search-input') }}">
                                    <button type="submit" class="searchButton">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>                        
                        <button class="filter-togle btn btn-warning">
                            <img src="{{ asset('nemolab/components/member/img/filter.png') }}" alt="">
                        </button>
                    </div>
                </div>
                @include('components.includes.member.sidebar-filter')
    
                <!-- Cards -->
                <div class="card-container col-md-9 pe-4" id="course-card">
                    <div class="row">
                        @if($courses->isEmpty() && $ebooks->isEmpty())
                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <div class="not-found text-center">
                                    <img src="{{ asset('nemolab/member/img/search-not-found.png') }}" class="logo-not-found w-50 h-50" alt="Not Found">
                                    <p class="mt-3">Kelas Yang Kamu Cari Tidak Tersedia</p>
                                </div>
                            </div>
                        {{-- sementara --}}
                        @elseif ($paketFilter == 'paket-bundling')
                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <div class="not-found text-center">
                                    <img src="{{ asset('nemolab/member/img/search-not-found.png') }}" class="logo-not-found w-50 h-50" alt="Not Found">
                                    <p class="mt-3">Kelas Yang Kamu Cari Tidak Tersedia</p>
                                </div>
                            </div>
                        @elseif ($paketFilter == 'paket-ebook')
                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <div class="not-found text-center">
                                    <img src="{{ asset('nemolab/member/img/search-not-found.png') }}" class="logo-not-found w-50 h-50" alt="Not Found">
                                    <p class="mt-3">Kelas Yang Kamu Cari Tidak Tersedia</p>
                                </div>
                            </div>
                            {{-- @foreach($ebooks as $ebook)
                                <div class="col-md-4 col-12 d-flex justify-content-center pb-3">
                                    <div class="card d-flex flex-row d-md-block">
                                        <img src="{{ asset('storage/images/covers/ebook/' . $ebook->cover) }}" class="card-img-top d-none d-md-block" alt="{{ $ebook->name }}" />
                                        <div class="card-head d-block d-md-none">
                                            <img src="{{ asset('storage/images/covers/ebook/' . $ebook->cover) }}" class="card-img-top" alt="{{ $ebook->name }}" />
                                            <div class="harga mt-4">
                                                <p class="p-0 m-0 fw-semibold">Harga</p>
                                                <p class="p-0 m-0 fw-bold">{{ $ebook->price == 0 ? 'Gratis' : 'Rp' . number_format($ebook->price, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="paket d-flex">
                                                <p class="paket-item mt-md-2">Kursus</p>
                                            </div>
                                            <div class="title-card">
                                                <h5 class="fw-bold truncate-text">{{ $ebook->category }} : {{ $ebook->name }}</h5>
                                                <p class="avatar m-0 fw-bold me-1"><img class="me-2" src="{{ asset('storage/images/avatars/' . $ebook->users->avatar) }}" alt="" />{{ $ebook->users->name }}</p>
                                            </div>
                                            <div class="btn-group-harga d-flex justify-content-between align-items-center mt-md-3">
                                                <div class="harga d-none d-md-block">
                                                    <p class="p-0 m-0 fw-semibold">Harga</p>
                                                    <p class="p-0 m-0 fw-semibold">{{ $ebook->price == 0 ? 'Gratis' : 'Rp' . number_format($ebook->price, 0, ',', '.') }}</p>
                                                </div>
                                                <a href="{{ route('member.ebook.join', $ebook->slug) }}" class="btn btn-primary">Mulai Belajar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach --}}
                        @else
                            @foreach($courses as $course)
                                <div class="col-md-4 col-12 d-flex justify-content-center pb-3">
                                    <div class="card d-flex flex-row d-md-block">
                                        <img src="{{ asset('storage/images/covers/' . $course->cover) }}" class="card-img-top d-none d-md-block" alt="{{ $course->name }}" />
                                        <div class="card-head d-block d-md-none">
                                            <img src="{{ asset('storage/images/covers/' . $course->cover) }}" class="card-img-top" alt="{{ $course->name }}" />
                                            <div class="harga mt-4">
                                                <p class="p-0 m-0 fw-semibold">Harga</p>
                                                <p class="p-0 m-0 fw-bold">{{ $course->price == 0 ? 'Gratis' : 'Rp' . number_format($course->price, 0, ',', '.') }}</p>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="paket d-flex">
                                                <p class="paket-item mt-md-2">Kursus</p>
                                            </div>
                                            <div class="title-card">
                                                <h5 class="fw-bold truncate-text">{{ $course->category }} : {{ $course->name }}</h5>
                                                <p class="avatar m-0 fw-bold me-1"><img class="me-2" src="{{ asset('storage/images/avatars/' . $course->users->avatar) }}" alt="" />{{ $course->users->name }}</p>
                                            </div>
                                            <div class="btn-group-harga d-flex justify-content-between align-items-center mt-md-3">
                                                <div class="harga d-none d-md-block">
                                                    <p class="p-0 m-0 fw-semibold">Harga</p>
                                                    <p class="p-0 m-0 fw-semibold">{{ $course->price == 0 ? 'Gratis' : 'Rp' . number_format($course->price, 0, ',', '.') }}</p>
                                                </div>
                                                <a href="{{ route('member.course.join', $course->slug) }}" class="btn btn-primary">Mulai Belajar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    

    {{-- <div class="right d-flex">
        <img src="http://127.0.0.1:8000/nemolab/member/img/star.png" style="height: 20px; margin-top: -1px;" alt="">
        <p class="text-black mb-0 ms-1">4,6</p>
    </div> --}}
@endsection
@push('addon-script')
<script>
    document.querySelector('.filter-togle').addEventListener('click', function() {
        const sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('show-sidebar'); // Toggle class untuk menampilkan atau menyembunyikan sidebar
    });
  </script>
<script>
    function elementFollowScroll(object, sectionContainer, topMargin, stopOn = false, footer) {
        $(window).on("scroll", function() {
            if ($(window).width() > 928) { 
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
                // Prevent the sidebar from following the scroll on mobile
                object.stop(false, false).css({
                    top: 0
                });
            }
        });
    }

    $(document).ready(function() {
        // Initialize sidebar sticky only if the window width is greater than 962 pixels
        const sidebar = $(".sidebar");
        const sectionContainer = $(".col-md-3");
        const topMargin = 90;
        const footer = $("footer"); 
        
        if ($(window).width() > 962) {
            elementFollowScroll(sidebar, sectionContainer, topMargin, false, footer);
        }
    });
</script>
@endpush

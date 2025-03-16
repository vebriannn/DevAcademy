@extends('components.layouts.member.app')

@section('title', 'Pilih Kursus Yang Ingin Anda Pelajari')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('devacademy/components/member/css/sidebar-filter.css') }} ">
    <link rel="stylesheet" href="{{ asset('devacademy/member/css/course.css') }} ">
@endpush

@section('content')
    <section class="section-pilh-kelas" id="section-pilih-kelas">
        <div class="container-fluid mt-5 pt-5">
            <div class="row">
                <div class="mobile-filter col-12 mb-5 d-lg-none fixed-top py-2">
                    <div class="filter-menu d-flex align-items-center gap-2">
                        <button class="filter-togle btn btn-warning">
                            <img src="{{ asset('devacademy/components/member/img/filter.png') }}" alt="">
                        </button>
                        <form action="{{ route('member.course') }}" method="GET" class="d-flex flex-grow-1">
                            <div class="search position-relative w-100">
                                <input type="text" name="search-input" class="searchTerm form-control"
                                    placeholder="Cari Kelas Disini" id="search-input" value="{{ request('search-input') }}">
                                <button type="submit" class="searchButton position-absolute">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('addon-script')
    <script src="{{ asset('devacademy/member/js/scroll-dashboard.js') }}"></script>
    <script>
        document.querySelector('.filter-togle').addEventListener('click', function() {
            const sidebar = document.querySelector('.sidebar');
            const body = document.body;

            sidebar.classList.toggle('show-sidebar');
            body.classList.toggle('no-scroll');
        });

        // Menutup sidebar saat mencapai footer
        window.addEventListener('scroll', function() {
            const sidebar = document.querySelector('.sidebar');
            const footer = document.querySelector('#footer');
            const body = document.body;

            const footerTop = footer.getBoundingClientRect().top;
            const sidebarBottom = sidebar.getBoundingClientRect().bottom;
            if (sidebarBottom >= footerTop) {
                sidebar.classList.remove('show-sidebar');
                body.classList.remove('no-scroll');
            }
        });

        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const toggleButton = document.querySelector('.filter-togle');
            const body = document.body;

            if (sidebar.classList.contains('show-sidebar') &&
                !sidebar.contains(event.target) &&
                !toggleButton.contains(event.target)) {
                sidebar.classList.remove('show-sidebar');
                body.classList.remove('no-scroll');
            }
        });
    </script>
@endpush

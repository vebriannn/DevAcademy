@extends('components.layouts.member.app')

@section('title', 'Nemolab - Pilih Kursus Yang Ingin Anda Pelajari')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/sidebar-filter.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/course.css') }} ">
@endpush

@section('content')
<section class="section-pilh-kelas" id="section-pilih-kelas">
    <div class="container-fluid mt-5 pt-5">
        <div class="row">
            <div id="loading-card" class="loading-placeholder d-none">
                <div class="card loading-card">
                    <div class="card-body">
                        <div class="loading-title"></div>
                        <div class="loading-text"></div>
                    </div>
                </div>
            </div>
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
            <div class="card-container col-md-9 pe-4" id="course-card">
                <div class="row" id="row">
                    @if($courses->isEmpty() && $ebooks->isEmpty())
                        <div class="col-md-12 d-flex justify-content-center align-items-center">
                            <div class="not-found text-center">
                                <img src="{{ asset('nemolab/member/img/search-not-found.png') }}" class="logo-not-found w-50 h-50" alt="Not Found">
                                <p class="mt-3">Kelas Yang Kamu Cari Tidak Tersedia</p>
                            </div>
                        </div>
                    @elseif ($paketFilter == 'paket-kursus')
                        @if ($courses->isEmpty())
                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <div class="not-found text-center">
                                    <img src="{{ asset('nemolab/member/img/search-not-found.png') }}" class="logo-not-found w-50 h-50" alt="Not Found">
                                    <p class="mt-3">Kelas Yang Kamu Cari Tidak Tersedia</p>
                                </div>
                            </div>
                        @endif
                        @foreach($courses as $course)
                            @include('components.includes.member.partials.course-card', ['course' => $course, 'bundling' => $bundling])
                        @endforeach
                    @elseif ($paketFilter == 'paket-ebook')
                        @if ($ebooks->isEmpty())
                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <div class="not-found text-center">
                                    <img src="{{ asset('nemolab/member/img/search-not-found.png') }}" class="logo-not-found w-50 h-50" alt="Not Found">
                                    <p class="mt-3">Kelas Yang Kamu Cari Tidak Tersedia</p>
                                </div>
                            </div>
                        @endif
                        @foreach($ebooks as $ebook)
                            @include('components.includes.member.partials.ebook-card', ['ebook' => $ebook])
                        @endforeach
                    @elseif ($paketFilter == 'paket-bundling')
                        @if ($courses->isEmpty())
                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <div class="not-found text-center">
                                    <img src="{{ asset('nemolab/member/img/search-not-found.png') }}" class="logo-not-found w-50 h-50" alt="Not Found">
                                    <p class="mt-3">Kelas Yang Kamu Cari Tidak Tersedia</p>
                                </div>
                            </div>
                        @endif
                        @foreach($courses as $course)
                            @include('components.includes.member.partials.course-card', ['course' => $course, 'bundling' => $bundling])
                        @endforeach
                    @else
                        @if($courses->isEmpty() && $ebooks->isEmpty())
                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <div class="not-found text-center">
                                    <img src="{{ asset('nemolab/member/img/search-not-found.png') }}" class="logo-not-found w-50 h-50" alt="Not Found">
                                    <p class="mt-3">Kelas Yang Kamu Cari Tidak Tersedia</p>
                                </div>
                            </div>
                        @endif
                        @foreach($courses as $course)
                            @include('components.includes.member.partials.course-card', ['course' => $course, 'bundling' => $bundling])
                        @endforeach
                        @foreach($ebooks as $ebook)
                            @include('components.includes.member.partials.ebook-card', ['ebook' => $ebook])
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('addon-script')
<script>
    
</script>
@endpush
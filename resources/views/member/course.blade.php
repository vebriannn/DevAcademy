@extends('components.layouts.member.app')

@section('title', 'Pilih Kursus Yang Ingin Anda Pelajari')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/sidebar-filter.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/course.css') }} ">

@endpush

@section('content')
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
            <div class="card-container col-md-9 pe-4" id="course-card">
                <div class="row" id="row">
                    @if($data->isEmpty() && $data->isEmpty())
                        <div class="col-md-12 d-flex justify-content-center align-items-center">
                            <div class="not-found text-center">
                                <img src="{{ asset('nemolab/member/img/search-not-found.png') }}" class="logo-not-found w-50 h-50" alt="Not Found">
                                <p class="mt-3">Kelas Yang Kamu Cari Tidak Tersedia</p>
                            </div>
                        </div>
                    @elseif ($paketFilter == 'paket-kursus')
                        @if ($data->isEmpty())
                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <div class="not-found text-center">
                                    <img src="{{ asset('nemolab/member/img/search-not-found.png') }}" class="logo-not-found w-50 h-50" alt="Not Found">
                                    <p class="mt-3">Kelas Yang Kamu Cari Tidak Tersedia</p>
                                </div>
                            </div>
                        @endif
                        @foreach($data as $course)
                            @include('components.includes.member.partials.course-card', ['course' => $course, 'bundling' => $bundling])
                        @endforeach
                    @elseif ($paketFilter == 'paket-ebook')
                        @if ($data->isEmpty())
                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <div class="not-found text-center">
                                    <img src="{{ asset('nemolab/member/img/search-not-found.png') }}" class="logo-not-found w-50 h-50" alt="Not Found">
                                    <p class="mt-3">Kelas Yang Kamu Cari Tidak Tersedia</p>
                                </div>
                            </div>
                        @endif
                        @foreach($data as $ebook)
                            @include('components.includes.member.partials.ebook-card', ['ebook' => $ebook])
                        @endforeach
                    @elseif ($paketFilter == 'paket-bundling')
                        @if ($data->isEmpty())
                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <div class="not-found text-center">
                                    <img src="{{ asset('nemolab/member/img/search-not-found.png') }}" class="logo-not-found w-50 h-50" alt="Not Found">
                                    <p class="mt-3">Kelas Yang Kamu Cari Tidak Tersedia</p>
                                </div>
                            </div>
                        @endif
                        @foreach($data as $course)
                            @include('components.includes.member.partials.course-card', ['course' => $course, 'bundling' => $bundling])
                        @endforeach
                    @else
                        @if($data->isEmpty())
                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <div class="not-found text-center">
                                    <img src="{{ asset('nemolab/member/img/search-not-found.png') }}" class="logo-not-found w-50 h-50" alt="Not Found">
                                    <p class="mt-3">Kelas Yang Kamu Cari Tidak Tersedia</p>
                                </div>
                            </div>
                        @else
                            {{-- Periksa apakah ada data course --}}
                            @if($data->where('product_type', 'video')->isNotEmpty())
                                @foreach($data->where('product_type', 'video') as $course)
                                    @include('components.includes.member.partials.course-card', ['course' => $course, 'bundling' => $bundling])
                                @endforeach
                            @endif
                            {{-- Periksa apakah ada data ebook --}}
                            @if($data->where('product_type', 'ebook')->isNotEmpty())
                                @foreach($data->where('product_type', 'ebook') as $ebook)
                                    @include('components.includes.member.partials.ebook-card', ['ebook' => $ebook])
                                @endforeach
                            @endif
                        @endif
                    @endif                    
                </div>                
                    {{-- <h1>{{ $data->count() }}</h1> --}}
            </div>
            <ul class="pagination justify-content-center justify-content-md-end">
                <li class="page-item-button fw-bold {{ $data->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $data->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                @php
                    $start = max($data->currentPage() - 2, 1); 
                    $end = min($start + 5, $data->lastPage());
                @endphp
                @for ($i = $start; $i <= $end; $i++)
                    <li class="page-item fw-bold {{ $i == $data->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $data->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item-button fw-bold {{ $data->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $data->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>            
        </div>
    </div>
</section>
@endsection

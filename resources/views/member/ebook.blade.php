@extends('components.layouts.member.app')

@section('title', 'eBook')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/ebook.css') }} ">
@endpush

@section('content')
<!-- Header -->
<div class="container mb-4" style="margin-top: 7rem">
    <div class="row">
      <div class="col-12 text-center justify-content-center">
        <h4 class="fw-semibold">Belajar Livewire Menengah: Membuat Aplikasi Manajemen<br />Karyawan Sederhana</h4>
        <p class="fw-light mt-3" style="font-size: 15px">Learn how to design Management from scratch</p>
        <!-- Ini -->
        <div class="d-flex align-items-center justify-content-center flex-md-row flex-column" style="margin-top: -6px; font-size: 15px">
          <div class="d-flex align-items-center">
            <img src="{{ asset('nemolab/member/img/global.png') }}" alt="" width="18" height="18" class="m-0" />
            <p class="m-0 ms-2 fw-light" style="font-size: 14px">Release date June 2022</p>
          </div>
          <div class="rating d-flex ms-1 my-1 my-0 align-items-center">
            <p class="m-0 ms-0 ms-md-5 me-2 fw-medium" style="font-size: 14px">4.9</p>
            <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19" />
            <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19" />
            <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19" />
            <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19" />
            <img src="{{ asset('nemolab/member/img/star.png') }}" alt="" width="19" height="19" />
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content -->
  <div class="container">
    <div class="row">
      <div class="col-12 rounded-3 border border-2 position-relative p-0 overflow-hidden" style="max-height: max-content">
        <!-- Tools -->
        <div class="p-4 px-5 w-100 d-flex justify-content-between align-items-center" style="background-color: #faa907">
          <div>
            <img src="{{ asset('nemolab/member/img/zoomin.png') }}" alt="" width="30" />
            <img src="{{ asset('nemolab/member/img/zoomout.png') }}" alt="" width="30" class="ms-3" />
          </div>
          <div>
            <p class="text-white fw-medium m-0">< 210 / 211 ></p>
          </div>
          <div class="d-flex align-items-center">
            <div class="search rounded-1 px-2">
              <label for="search"><img src="{{ asset('nemolab/member/img/search-ebook.png') }}" alt="" width="25" /></label>
              <input type="text" id="search" />
            </div>
            <div class="ms-5">
              <img src="{{ asset('nemolab/member/img/fullscreen.png') }}" alt="" width="30" />
            </div>
          </div>
        </div>
        <!-- PDF -->
        <div><h1>HAHAHAAHAHAH</h1></div>
      </div>
    </div>
  </div>
@endsection
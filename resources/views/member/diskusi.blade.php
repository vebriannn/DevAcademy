@extends('components.layouts.member.navback')

@section('title', 'Forum Diskusi')

@section('content')
    @push('prepend-style')
        <link rel="stylesheet" href="{{ asset('nemolab/member/css/diskusi.css') }} ">
    @endpush
    <div class="container">
        <h3 class="text-center text-black" style="margin-top: 13rem">Forum Diskusi</h3>
        <div class="box mx-auto mt-5">
            <img src="{{ asset('nemolab/member/img/search-diskusi.png') }}" alt="">
            <input type="search" name="" id="" placeholder="Cari Pertanyaan Serupa">
        </div>
        <div class="diskusi d-flex flex-column" style="margin-top: 100px">
            <div class="input-comment mx-auto mb-5">
                <div class="form-floating mx-auto">
                    <textarea class="form-control" placeholder="" id="floatingTextarea" style="height: 100px"></textarea>
                    <label class="fw-light" style="color: #414142;" for="floatingTextarea">Berikan pertanyaan</label>
                </div>
                <a href="#" class="btn-kirim mt-3 fw-semibold text-white rounded-3 float-end">Kirim</a>
            </div>
            <div class="card card-diskusi p-3 mx-auto mt-5">
                <div class="profile d-flex">
                    <a class="fw-semibold mb-0 text-black">@riyandadi</a>
                    <p class="ms-3 fw-light mb-0">10 jam yang lalu</p>
                </div>
                <div class="reply-mentor d-flex mt-2">
                    <img src="{{ asset('nemolab/member/img/reply-mentor.png') }}" width="25" height="25"
                        alt="">
                    <p class="ms-2">Dijawab Mentor</p>
                </div>
                <div class="question">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Soluta temporibus tempora optio est libero
                    excepturi, enim provident a laboriosam nam officia quos nobis aliquid. Quos deserunt voluptatibus
                    tempora neque tempore.
                </div>
                <div class="action-balas">
                    <p class="d-inline-flex gap-1 mb-0">
                        <a class="text-black fw-semibold" data-bs-toggle="collapse" href="#collapsecomment" role="button"
                            aria-expanded="false" aria-controls="collapseExample" onclick="toggleChevron()" style="">
                            <img class="my-auto" id="chevron" src="{{ asset('nemolab/member/img/chevron-down-orange.png') }}"
                                width="20" height="20" alt="">
                            Balasan
                        </a>
                    </p>
                    <p class="d-inline-flex gap-1 mb-0">
                        <a class="text-black ms-3" data-bs-toggle="collapse" href="#collapsereply" role="button"
                            aria-expanded="false" aria-controls="collapseExample" onclick="toggleChevron()" style="">
                            Balas
                        </a>
                    </p>
                </div>
                <div class="collapse" id="collapsereply">
                    <div class="card card-body ps-4 pe-0 py-1">
                        <div class="input-group flex-nowrap">
                            <input type="text" class="form-control" placeholder="Balas" aria-label="Username" aria-describedby="addon-wrapping">
                          </div>
                    </div>
                </div>
                <div class="collapse" id="collapsecomment">
                    <div class="card card-body ps-4 pe-0 py-1">
                        <a class="fw-semibold mb-0 text-black">@riyandadi</a>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eveniet maiores ipsam ipsum delectus unde
                        facilis.
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('addon-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var collapseElement = document.getElementById('collapseExample');
            var chevronIcon = document.getElementById('chevron');

            // Change chevron when collapse is shown
            collapseElement.addEventListener('shown.bs.collapse', function() {
                chevronIcon.src = "{{ asset('nemolab/member/img/chevron-up-orange.png') }}";
            });

            // Change chevron when collapse is hidden
            collapseElement.addEventListener('hidden.bs.collapse', function() {
                chevronIcon.src = "{{ asset('nemolab/member/img/chevron-down-orange.png') }}";
            });
        });
    </script>
@endpush

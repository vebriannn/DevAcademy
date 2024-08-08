@extends('components.layouts.member.joinclass')

@section('title, nemolab')

@section('back', 'My Course')

@section('contentclassvideo')

    <div class="container mb-5" id="content">
        <div class="row mt-4">
            <div class="col-lg-3 col-md-3 col-sm-12">
                <div class="card costum-card">
                    <p class="text-center fs-5 text-white fw-bold pt-2 border-bottom">Materi</p>
                    <div class="d-grid gap-2 px-3">
                        @foreach ($chapters as $chapter)
                            <div class="accordion" id="accordionPanelsStayOpenExample">
                                <div class="accordion-item mt-3">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#panelsStayOpen-collapse-{{ $loop->iteration }}"
                                            aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                                            {{ $chapter->name }}
                                        </button>
                                    </h2>
                                </div>
                                <div id="panelsStayOpen-collapse-{{ $loop->iteration }}"
                                    class="accordion-collapse collapse">
                                    @foreach ($chapter->lessons as $lesson)
                                        <div class="accordion-body">
                                            <a href="{{ route('member.course.play', ['slug' => $slug, 'episode' => $lesson->episode]) }}"
                                                class="btn btn-primary btn-video mx-auto mt-3 d-flex justify-content-between">
                                                <div class="d-flex play">
                                                    <img src="{{ asset('nemolab\assets\image\play.png') }}" alt="">
                                                    <p class="ms-2 my-auto opacity-75">{{$lesson->name}}</p>
                                                </div>
                                                <div class="bg-white rounded-circle check"></div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12">
                <iframe width="100%" height="490px" src="{{ $play->video }}" title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12"></div>
            <div class="about col-lg-9 col-md-9 col-sm-12 d-flex mt-3">
                <div class="wrapper">
                    <div class="title-deskripsi">
                        <h4>{{$course->name}}</h4>
                        <p>Materi bagian: {{$play->name}}</p>
                    </div>
                    <div class="profile-mentor d-flex">
                        <img src="{{ asset('nemolab/assets/image/profile2.png') }}" alt="">
                        <p class="ms-2">Radiansyah</p>
                    </div>
                    <div class="resource">
                        <h4 class="fw-bold mt-3">Resource</h4>
                        <div class="d-flex course-option mt-3">
                            <a href="download" class="btn btn-download d-flex align-item-center">
                                <img src="{{ asset('nemolab/assets/image/download.png') }}" alt="">
                                <div class="text-download ms-3">
                                    <p class="my-auto text-left" style="width:70%;">Download</p>
                                    <p class="my-auto">Assets Belajar</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary btn-play mb-3 ms-auto">Complete</button>
            </div>

        </div>
    </div>
@endsection

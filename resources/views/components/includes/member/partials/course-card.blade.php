<div class="col-md-4 col-12 d-flex justify-content-center my-1 pb-3">
    <div class="card d-block flex-row">
        @if ($course->cover != null)
            <img src="{{ asset('storage/images/covers/' . $course->cover) }}" class="card-img-top  d-block"
                alt="{{ $course->name }}" />
        @else
            <img src="{{ asset('devacademy/member/img/NemolabBG.jpg') }}" class="card-img-top  d-block"
                alt="{{ $course->name }}" />
        @endif
        {{-- <div class="card-head d-block d-md-none">
            @if ($course->cover != null)
                <img src="{{ asset('storage/images/covers/' . $course->cover) }}" class="card-img-top"
                    alt="{{ $course->name }}" />
            @else
                <img src="{{ asset('devacademy/member/img/NemolabBG.jpg') }}" class="card-img-top"
                    alt="{{ $course->name }}" />
            @endif
            <div class="harga mt-4">
                <p class="p-0 m-0 fw-bold">Harga</p>
                <p class="p-0 m-0 fw-bold">
                    @php
                        $currentBundling = $bundling[$course->id] ?? null;
                    @endphp
                    {{ $currentBundling
                        ? ($currentBundling->price == 0
                            ? 'Gratis'
                            : 'Rp' . number_format($currentBundling->price, 0, ',', '.'))
                        : ($course->price == 0
                            ? 'Gratis'
                            : 'Rp' . number_format($course->price, 0, ',', '.')) }}
                </p>
            </div>
        </div> --}}
        <div class="card-body">
            <div class="title-card">
                <h5 class="fw-bold truncate-text">{{ $course->category }} : {{ $course->name }}</h5>
            </div>
            <div class="btn-group-harga d-flex justify-content-between mt-md-3">
                {{-- <div class="avatar m-0 fw-bold me-1"> --}}
                    <div class="profile">
                        @if ($course->users->avatar != null)
                        <img class="me-2" src="{{ asset('storage/images/avatars/' . $course->users->avatar) }}"
                            alt="" />
                    @else
                        <img class="me-2" src="{{ asset('devacademy/member/img/icon/Group 7.png') }}" alt="" />
                    @endif
                    {{ $course->users->name }}
                    </div>
                    <div class="btn-group-harga d-flex justify-content-between align-items-center">
                        <div class="harga">
                            <div class="d-flex sertifikat">
                                <img class="me-2 icon-serti" id="check-icon"
                                src="{{ asset('devacademy/member/img/icon/check-serti.svg') }}"
                                alt="" />
                                <p class="p-0 m-0 fw-semibold">Sertifikat</p>
                            </div>
                            <p class="p-0 m-0 mt-2 price fw-semibold float-end">
                                @php
                                    $currentBundling = $bundling[$course->id] ?? null;
                                @endphp
                                {{ $currentBundling
                                    ? ($currentBundling->price == 0
                                        ? 'Gratis'
                                        : 'Rp' . number_format($currentBundling->price, 0, ',', '.'))
                                    : ($course->price == 0
                                        ? 'Gratis'
                                        : 'Rp' . number_format($course->price, 0, ',', '.')) }}
                            </p>
                        </div>
                    </div>
                {{-- </div> --}}
            </div>
            <a href="{{ route('member.course.join', $course->slug) }}" class="btn btn-primary py-2 mt-3">Mulai Belajar</a>
        </div>
    </div>
</div>

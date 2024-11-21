<div class="col-md-4 col-12 d-flex justify-content-center my-1 pb-3">
    <div class="card d-flex flex-row d-md-block">
        @if ($course->cover != null)
            <img src="{{ asset('storage/images/covers/' . $course->cover) }}" class="card-img-top d-none d-md-block"
                alt="{{ $course->name }}" />
        @else
            <img src="{{ asset('nemolab/member/img/NemolabBG.jpg') }}" class="card-img-top d-none d-md-block"
                alt="{{ $course->name }}" />
        @endif
        <div class="card-head d-block d-md-none">
            @if ($course->cover != null)
                <img src="{{ asset('storage/images/covers/' . $course->cover) }}" class="card-img-top"
                    alt="{{ $course->name }}" />
            @else
                <img src="{{ asset('nemolab/member/img/NemolabBG.jpg') }}" class="card-img-top"
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
        </div>
        <div class="card-body">
            <div class="paket d-flex">
                <p class="paket-item mt-md-2">{{ isset($bundling[$course->id]) ? 'Paket Combo' : 'Kursus' }}</p>
            </div>
            <div class="title-card">
                <h5 class="fw-bold truncate-text">{{ $course->category }} : {{ $course->name }}</h5>
                <p class="avatar m-0 fw-bold me-1">
                    @if ($course->users->avatar != null)
                        <img class="me-2" src="{{ asset('storage/images/avatars/' . $course->users->avatar) }}"
                            alt="" />
                    @else
                        <img class="me-2" src="{{ asset('nemolab/member/img/icon/Group 7.png') }}" alt="" />
                    @endif
                    {{ $course->users->name }}
                </p>
            </div>
            <div class="btn-group-harga d-flex justify-content-between align-items-center mt-md-3">
                <div class="harga d-none d-md-block">
                    <p class="p-0 m-0 fw-semibold">Harga</p>
                    <p class="p-0 m-0 fw-semibold">
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
                <a href="{{ route('member.course.join', $course->slug) }}" class="btn btn-primary">Mulai Belajar</a>
            </div>
        </div>
    </div>
</div>

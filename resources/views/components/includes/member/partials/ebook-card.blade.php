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
                <p class="paket-item mt-md-2">E-book</p>
            </div>
            <div class="title-card">
                <h5 class="fw-bold truncate-text">{{ $ebook->category }} : {{ $ebook->name }}</h5>
                <p class="avatar m-0 fw-bold me-1">
                    <img class="me-2" src="{{ asset('storage/images/avatars/' . $ebook->users->avatar) }}" alt="" />
                    {{ $ebook->users->name }}
                </p>
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

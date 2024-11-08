<div class="col-md-3 d-none d-md-block p-0">
    <div class="col-md-9 ms-5">
        <div class="sidebar" id="sidebar">
            <div class="profile">
                <h5 class="">DASHBOARD SAYA</h5>
                <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}" alt="avatar" width="100" height="100" class="avatar class mb-3" 
                style="border-radius: 50%; object-fit: cover" />
                <p class="name fs-5">{{ Auth::user()->name }}</p>
                <p class="posisi mt-0">{{ Auth::user()->profession }}</p>
            </div>
            <div class="menu">
                <ul class="side-tabs">
                    <li  class="active"><a href="{{ route('member.dashboard') }}"><img src="{{ asset('nemolab/components/member/img/Frame 8.png') }}" alt="icon">Kelas Saya</a></li>
                    <li><a href="{{ route('member.transaction') }}"><img src="{{ asset('nemolab/components/member/img/Frame 10.png') }}" alt="icon">Transaksi Saya</a></li>
                    <li><a href="{{ route('member.setting') }}"><img src="{{ asset('nemolab/components/member/img/Frame 11.png') }}" alt="icon">Pengaturan</a></li>
                    <li class="mt-4"><a href="{{ route('member.logout') }}"><img src="{{ asset('nemolab/components/member/img/Frame 12.png') }}" alt="icon">Keluar</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
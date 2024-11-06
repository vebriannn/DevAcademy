<div class="col-md-5 col-xl-3 d-none d-md-block p-0" id="parent-sidebar">
    <div class="col-md-9 ms-5">
        <div class="sidebar" id="sidebar">
            <div class="profile text-center">
                <h5 class="">DASHBOARD SAYA</h5>
                @if (Auth::user()->avatar != null)
                    <img src="{{ asset('storage/images/avatars/' . Auth::user()->avatar) }}" alt="avatar" width="100"
                        height="100" class="avatar mb-3" style="border-radius: 50%; object-fit: cover;" />
                @else
                    <img src="{{ asset('nemolab/member/img/icon/Group 7.png') }}" class="rounded-5 ms-1"
                        style="width: 42px; height: 42px;" id="img-profile">
                @endif
                <p class="name fs-5 m-0 p-0">{{ Auth::user()->name }}</p>
                <p class="posisi mt-0">{{ Auth::user()->profession }}</p>
            </div>
            <div class="menu">
                <ul class="side-tabs">
                    <li>
                        <a href="#">
                            <img src="{{ asset('nemolab/components/member/img/icon-menu/img-course.png') }}"
                                alt="icon">
                            Kelas Saya
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{ asset('nemolab/components/member/img/icon-menu/img-transaction.png') }}"
                                alt="icon">
                            Transaksi Saya
                        </a>
                    </li>
                    <li class="active">
                        <a href="#">
                            <img src="{{ asset('nemolab/components/member/img/icon-menu/img-setting-active.png') }}"
                                alt="icon">Pengaturan
                        </a>
                    </li>
                    <!-- <li class="mt-4"><a href="#"><img src="{{ asset('nemolab/member/img/icon/sidebar/Frame 12.png') }}"
                                        alt="icon">Keluar</a></li> -->
                </ul>
            </div>
        </div>
    </div>
</div>

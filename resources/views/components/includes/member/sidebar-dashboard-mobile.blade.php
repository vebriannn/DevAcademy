<section class="sidebar-mobile-section" id="sidebar-mobile-section">
    <div class="container">
        <div class="row shadow">
            <!-- Kelas -->
            <div class="col-4 col-sm-3 d-flex align-items-center flex-column">
                <a href="{{ route('member.dashboard') }}" class="text-decoration-none d-flex align-items-center flex-column {{ Request::is('member') ? 'active' : '' }}">
                    <img src="{{ asset('nemolab/components/member/img/icon-menu/course.png') }}" class="{{ Request::is('member') ? 'active' : '' }}">
                    <p class="m-0 p-0 mt-1 {{ Request::is('member') ? 'active' : '' }}">Kelas</p>
                </a>
            </div>
            
            <!-- Transaksi -->
            <div class="col-4 col-sm-3 d-flex justify-content-center align-items-center flex-column">
                <a href="{{ route('member.transaction') }}" class="text-decoration-none d-flex align-items-center flex-column {{ Request::is('member/transaction') ? 'active' : '' }}">
                    <img src="{{ asset('nemolab/components/member/img/icon-menu/img-transaction.png') }}" class="{{ Request::is('member/transaction') ? 'active' : '' }}">
                    <p class="m-0 p-0 mt-1 {{ Request::is('member/transaction') ? 'active' : '' }}">Transaksi</p>
                </a>
            </div>
            
            <!-- Pengaturan -->
            <div class="col-4 col-sm-3 d-flex justify-content-end align-items-center flex-column">
                <a href="{{ route('member.setting') }}" class="text-decoration-none d-flex align-items-center flex-column {{ Request::is('member/setting') ? 'active' : '' }}">
                    <img src="{{ asset('nemolab/components/member/img/icon-menu/img-setting-active.png') }}" class="{{ Request::is('member/setting') ? 'active' : '' }}">
                    <p class="m-0 p-0 mt-1 {{ Request::is('member/setting') ? 'active' : '' }}">Pengaturan</p>
                </a>
            </div>
        </div>
    </div>
</section>

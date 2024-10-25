@extends('components.layouts.member.dashboard')

@section('title', 'Nemolab - Lihat informasi dan perkembangan anda disini')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/sidebar-dashboard.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/dashboard-css/setting.css') }} ">
    @endpush
@section('content')
<section class="section-pilih-kelas" id="section-pilih-kelas">
    <div class="container-fluid mt-5 pt-5">
        <div class="row">
            @include('components.includes.member.sidebar-dashboard')
            <div class="col-12 col-lg-9">
                <div class="row gy-4">
                    <a href="{{ route('member.edit-profile') }}" class="col-md-6 text-decoration-none">
                        <div class="setting-item">
                            <div class="icon py-2 px-3 mx-3">
                                <img src="{{ asset('nemolab/components/member/img/card-profile.png') }}" alt="">
                            </div>
                            <div class="content ms-1 mt-3">
                                <h3>Ubah profil anda</h3>
                                <p>Ketuk untuk mengubah data diri anda disini</p>
                            </div>
                            <div class="toggle me-3">
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('member.edit-password') }}" class="col-md-6 text-decoration-none">
                        <div class="setting-item">
                            <div class="icon py-2 px-3 mx-3">
                                <img src="{{ asset('nemolab/components/member/img/auth.png') }}" alt="">
                            </div>
                            <div class="content ms-1 mt-3">
                                <h3>Ubah kata sandi anda</h3>
                                <p>Ketuk untuk mengubah kata sandi anda disini</p>
                            </div>
                            <div class="toggle me-3">
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </a>

                    <a href="{{ route('member.edit-email') }}" class="col-md-6 text-decoration-none">
                        <div class="setting-item">
                            <div class="icon py-2 px-3 mx-3">
                                <img src="{{ asset('nemolab/components/member/img/message.png') }}" alt="">
                            </div>
                            <div class="content ms-1 mt-3">
                                <h3>Ubah email anda</h3>
                                <p>Ketuk untuk mengubah email anda disini</p>
                            </div>
                            <div class="toggle me-3">
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@push('addon-script')
<script>
    function elementFollowScroll(object, sectionContainer, topMargin, stopOn = false, footer) {
        $(window).on("scroll", function() {
            if ($(window).width() > 962) { 
                let originalY = sectionContainer.offset().top;
                let scrollTop = $(window).scrollTop();
                let footerTop = footer.offset().top; 
                let sidebarHeight = object.outerHeight(true); 
                let stopPoint = footerTop - sidebarHeight - topMargin; 

                if (stopOn === false) {
                    let newTop = scrollTop < originalY ? 0 : scrollTop - originalY + topMargin;
                    if (scrollTop + sidebarHeight + topMargin >= footerTop) {
                        object.stop(false, false).animate({ top: stopPoint - originalY }, 50);
                    } else {
                        object.stop(false, false).animate({ top: newTop }, 50);
                    }
                } else {
                    let newTop = scrollTop < originalY ? 0 : Math.min(sectionContainer.height() - object.height() - 52, scrollTop - originalY + topMargin);
                    if (scrollTop + sidebarHeight + topMargin >= footerTop) {
                        object.stop(true, true).animate({ top: stopPoint - originalY }, 50);
                    } else {
                        object.stop(true, true).animate({ top: newTop }, 50);
                    }
                }
            } else {
                object.stop(false, false).css({
                    top: 0
                });
            }
        });
    }
    $(document).ready(function() {
        // Inisialisasi sidebar sticky
        const sidebar = $(".sidebar");
        const sectionContainer = $(".col-md-3");
        const topMargin = 90;
        const footer = $("footer"); 
        elementFollowScroll(sidebar, sectionContainer, topMargin, false, footer);
    });
</script>
@endpush

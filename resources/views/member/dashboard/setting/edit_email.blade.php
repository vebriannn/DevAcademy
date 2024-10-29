@extends('components.layouts.member.dashboard')

@section('title', 'Nemolab - Lihat informasi dan perkembangan anda disini')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/components/member/css/dashboard/sidebar-dashboard.css') }} ">
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/dashboard-css/setting.css') }} ">
    @endpush
@section('content')
<section class="profile-saya-section" id="profile-saya-section">
    <div class="container-fluid mt-5 pt-5">
        <div class="row">
            <!-- Sidebar -->
            @include('components.includes.member.sidebar-dashboard')
            <!-- Profile Form -->
            <div class="col-md-9">
                <div class="card profile-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <h5 class="title ps-3 fw-bold">Ubah email anda</h5>
                        </div>
                        <form action="{{ route('member.update-email') }}" method="POST" class="edit-form">
                            @csrf
                            <div class="row">
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-bold">Email saat ini</label>
                                    <input type="email" id="email" name="email" class="form-control fw-bold" value="{{ Auth::user()->email }}" readonly style="cursor: pointer; background-color:#E8E8E8 ;">
                                </div>
                                <div class="mb-3">
                                    <label for="new_email" class="form-label fw-bold">Email Baru</label>
                                    <input type="email" id="new_email" name="new_email" class="form-control fw-bold" placeholder="Masukan email baru anda" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-primary w-100 rounded-start fw-bold">Simpan Perubahan</button>
                                </div>
                            </div>
                        </form>  
                    </div>
                </div>
            </div>          
        </div>
    </div>
</section>

@endsection

@push('addon-script')
<script>
    document.getElementById('fileUpload').addEventListener('change', function(event) {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('avatarPreview').src = e.target.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    });
</script>   
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

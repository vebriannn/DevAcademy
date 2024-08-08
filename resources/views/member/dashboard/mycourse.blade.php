@extends('components.layouts.member.dashboard')

@section('content-mycourse')
    <link rel="stylesheet" href="{{ asset('nemolab/assets/css/dashboradmycourse.css') }}">
    <link rel="stylesheet" href="{{ asset('nemolab/assets/css/components/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('nemolab/assets/css/dashboardsettings.css') }}">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-3 d-none d-lg-block p-4 rounded-4 text-white" style="background-color: #faa907">
                <img src="{{ asset('nemolab/assets/image/profile2.png') }}" alt="" width="70"
                    class="d-flex mx-lg-auto mt-3" />
                <h4 class="m-0 mt-lg-5 mt-3 fw-semibold">Kenzo Ardiano</h4>
                <p class="m-0 fw-light">Status Member</p>
                <div class="mt-5">
                    <a href="#" class="list-sidebar active">
                        <img src="{{ asset('nemolab/assets/image/course active.png') }}" alt="" width="30" />
                        <p class="m-0">My Courses</p>
                    </a>
                    <a href="#" class="list-sidebar">
                        <img src="{{ asset('nemolab/assets/image/portofolio.png') }}" alt="" width="30" />
                        <p class="m-0">My Portofolio</p>
                    </a>
                    <a href="dashboard-transactions.html" class="list-sidebar">
                        <img src="{{ asset('nemolab/assets/image/transaksi.png') }}" alt="" width="30" />
                        <p class="m-0">Transactions</p>
                    </a>
                    <a href="#" class="list-sidebar">
                        <img src="{{ asset('nemolab/assets/image/setting.png') }}" alt="" width="30"/>
                        <p class="m-0">Settings</p>
                    </a>
                </div>
              </div>
            <!-- End Sidebar -->

            <!-- Content -->            
            <div class="col-lg-9 col-md-12 ps-5">
                <h3 class="fw-bold tittle">My Courses</h3>
                <div class="course row row-course mt-3 w-100">
                    <div class="col-lg-4 col-sm-6 col-course mt-1 mb-2">
                        <div class="card-course h-100 d-flex flex-column">
                            <div class="img-card">
                                <img src="{{ asset('nemolab/assets/image/Design.png') }}" alt="">
                            </div>
                            <div class="deskripsi px-3 ">
                                <div class="category">
                                    <p class="m-0">UI/UX Design</p>
                                </div>
                                <div class="tittle-card fw-semibold">
                                    Design Grafis: Learn basics Part 1 mempelajari
                                </div>
                                <div class="profile-card mt-2">
                                    <a href="">
                                        <img class="me-2" src="{{ asset('nemolab/assets/image/avatar.png') }}" alt="" width="30" />
                                        Julian Ardan
                                    </a>
                                </div>
                                <div class="status d-flex mt-3">
                                    <div class="d-flex flex-direction-costum">
                                        <p class="txt-start">Start</p>
                                        <p class="date ms-3">20 September</p>
                                    </div>
                                    <img class="ms-auto me-0 " src="{{ asset('nemolab/assets/image/check-mycourse.png') }}" alt="" width="30" height="30">
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-4 col-sm-6 col-course mt-1 mb-2">
                        <div class="card-course h-100 d-flex flex-column">
                            <div class="img-card">
                                <img src="{{ asset('nemolab/assets/image/Design.png') }}" alt="">
                            </div>
                            <div class="deskripsi px-3 ">
                                <div class="category">
                                    <p class="m-0">UI/UX Design</p>
                                </div>
                                <div class="tittle-card fw-semibold">
                                    Design Grafis: Learn basics Part 1 mempelajari
                                </div>
                                <div class="profile-card mt-2">
                                    <a href="">
                                        <img class="me-2" src="{{ asset('nemolab/assets/image/avatar.png') }}" alt="" width="30" />
                                        Julian Ardan
                                    </a>
                                </div>
                                <div class="status d-flex mt-3">
                                    <div class="d-flex flex-direction-costum">
                                        <p class="txt-start">Start</p>
                                        <p class="date ms-3">20 September</p>
                                    </div>
                                    <img class="ms-auto me-0 " src="{{ asset('nemolab/assets/image/check-mycourse.png') }}" alt="" width="30" height="30">
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection

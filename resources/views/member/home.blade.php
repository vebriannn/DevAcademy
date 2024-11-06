@extends('components.layouts.member.app')

@section('title', 'Belajar Kursus Online di mana pun dan kapan pun')

@push('addon-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/home.css') }}">
@endpush

@section('content')

    <!-- section 1 -->
    <section class="section-hero-img d-flex align-items-center" id="section-hero-img">
        <div class="row align-items-center">
            <div class="col-12 col-xl-6  mt-5 mt-xl-0" data-aos="zoom-out">
                <div class="text-xl-start text-center"> <!-- Added this wrapper for centering -->
                    <h1 class="fw-bold">BELAJAR KURSUS ONLINE GRATIS, KAPANPUN DAN DIMANAPUN</h1>
                    <p>Belajar keahlian seputar teknologi dari pemula hingga ahli, dapatkan berbagai macam kelas
                        mulai
                        yang gratis hingga yang berbayar</p>
                    <a href="course.html" class="btn btn-primary px-4 pt-2 pb-2 mt-2">Mulai Belajar</a>
                </div>
            </div>
            <div class="col-12 col-xl-6 d-none d-xl-block mt-5" data-aos="zoom-out" data-aos-delay="100">
                <img src="{{ asset('nemolab/member/img/lp-hero-1.png') }}" alt="" class="img-fluid">
            </div>
        </div>
    </section>

    <!-- section 2 -->
    <section class="section-pilh-kelas" id="section-pilih-kelas" data-aos="fade-up">
        <div class="container-fluid p-0 m-0">
            <div class="title-pilih-kelas d-flex justify-content-between align-items-center pt-5">
                <div class="title-group ">
                    <h1 class="title-kelas fw-bold">
                        Pilihan Kelas
                    </h1>
                    <p class="subtitle-kelas">Beralih menjadi profesional dari sekarang dengan memilih kelas dan
                        mulai
                        belajar</p>
                </div>
                <a href="course.html" class="btn fw-bold d-none d-md-block">Lihat Kelas Lainnya</a>
            </div>
            <div class="content-kelas">
                <div class="row m-0 p-0 d-flex justify-content-around justify-content-xl-center mt-5">
                    <div class="col-12 col-sm-5 col-xl-3 col-12 d-flex justify-content-center pb-3">
                        <div class="card d-flex flex-row d-md-block">
                            <img src="{{ asset('nemolab/member/img/image-design-ui-ux-chat-gpt.png') }}"
                                class="card-img-top d-none d-md-block" alt="..." />
                            <div class="card-head d-block d-md-none">
                                <img src="{{ asset('nemolab/member/img/image-design-ui-ux-chat-gpt.png') }}"
                                    class="card-img-top" alt="..." />
                                <div class="harga mt-4 ">
                                    <p class="p-0 m-0 fw-semibold">Harga</p>
                                    <p class="p-0 m-0 fw-bold">Gratis</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="paket d-flex">
                                    <p class="paket-item mt-md-2">Kursus</p>
                                    <p class="paket-item mt-md-2">E-book</p>
                                </div>
                                <div class="title-card">
                                    <h5 class="fw-bold truncate-text">UI/UX Designer: Belajar UI/UX Designer untuk
                                        pemula</h5>
                                    <p class="avatar m-0"><img src="{{ asset('nemolab/member/img/icon/Group 7.png') }}"
                                            alt="" /> Naufal
                                        Haidar Azhar</p>
                                </div>
                                <div class="btn-group-harga d-flex justify-content-between align-items-center mt-md-3">
                                    <div class="harga d-none d-md-block">
                                        <p class="p-0 m-0 fw-semibold">Harga</p>
                                        <p class="p-0 m-0 fw-semibold">Gratis</p>
                                    </div>
                                    <a href="detail-course.html" class="btn btn-primary">Mulai Belajar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-5 col-xl-3 col-12 d-flex justify-content-center pb-3">
                        <div class="card d-flex flex-row d-md-block">
                            <img src="{{ asset('nemolab/member/img/image-design-ui-ux-chat-gpt.png') }}"
                                class="card-img-top d-none d-md-block" alt="..." />
                            <div class="card-head d-block d-md-none">
                                <img src="{{ asset('nemolab/member/img/image-design-ui-ux-chat-gpt.png') }}"
                                    class="card-img-top" alt="..." />
                                <div class="harga mt-4 ">
                                    <p class="p-0 m-0 fw-semibold">Harga</p>
                                    <p class="p-0 m-0 fw-bold">Gratis</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="paket d-flex">
                                    <p class="paket-item mt-md-2">Kursus</p>
                                    <p class="paket-item mt-md-2">E-book</p>
                                </div>
                                <div class="title-card">
                                    <h5 class="fw-bold truncate-text">UI/UX Designer: Belajar UI/UX Designer untuk
                                        pemula</h5>
                                    <p class="avatar m-0"><img src="{{ asset('nemolab/member/img/icon/Group 7.png') }}"
                                            alt="" /> Naufal
                                        Haidar Azhar</p>
                                </div>
                                <div class="btn-group-harga d-flex justify-content-between align-items-center mt-md-3">
                                    <div class="harga d-none d-md-block">
                                        <p class="p-0 m-0 fw-semibold">Harga</p>
                                        <p class="p-0 m-0 fw-semibold">Gratis</p>
                                    </div>
                                    <a href="detail-course.html" class="btn btn-primary">Mulai Belajar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-5 col-xl-3 col-12 d-flex justify-content-center pb-3 mt-sm-5 mt-xl-0">
                        <div class="card d-flex flex-row d-md-block">
                            <img src="{{ asset('nemolab/member/img/image-design-ui-ux-chat-gpt.png') }}"
                                class="card-img-top d-none d-md-block" alt="..." />
                            <div class="card-head d-block d-md-none">
                                <img src="{{ asset('nemolab/member/img/image-design-ui-ux-chat-gpt.png') }}"
                                    class="card-img-top" alt="..." />
                                <div class="harga mt-4 ">
                                    <p class="p-0 m-0 fw-semibold">Harga</p>
                                    <p class="p-0 m-0 fw-bold">Gratis</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="paket d-flex">
                                    <p class="paket-item mt-md-2">Kursus</p>
                                    <p class="paket-item mt-md-2">E-book</p>
                                </div>
                                <div class="title-card">
                                    <h5 class="fw-bold truncate-text">UI/UX Designer: Belajar UI/UX Designer untuk
                                        pemula</h5>
                                    <p class="avatar m-0"><img src="{{ asset('nemolab/member/img/icon/Group 7.png') }}"
                                            alt="" /> Naufal
                                        Haidar Azhar</p>
                                </div>
                                <div class="btn-group-harga d-flex justify-content-between align-items-center mt-md-3">
                                    <div class="harga d-none d-md-block">
                                        <p class="p-0 m-0 fw-semibold">Harga</p>
                                        <p class="p-0 m-0 fw-semibold">Gratis</p>
                                    </div>
                                    <a href="detail-course.html" class="btn btn-primary">Mulai Belajar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-5 col-xl-3 col-12 d-flex justify-content-center pb-3 mt-sm-5 mt-xl-0">
                        <div class="card d-flex flex-row d-md-block">
                            <img src="{{ asset('nemolab/member/img/image-design-ui-ux-chat-gpt.png') }}"
                                class="card-img-top d-none d-md-block" alt="..." />
                            <div class="card-head d-block d-md-none">
                                <img src="{{ asset('nemolab/member/img/image-design-ui-ux-chat-gpt.png') }}"
                                    class="card-img-top" alt="..." />
                                <div class="harga mt-4 ">
                                    <p class="p-0 m-0 fw-semibold">Harga</p>
                                    <p class="p-0 m-0 fw-bold">Gratis</p>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="paket d-flex">
                                    <p class="paket-item mt-md-2">Kursus</p>
                                    <p class="paket-item mt-md-2">E-book</p>
                                </div>
                                <div class="title-card">
                                    <h5 class="fw-bold truncate-text">UI/UX Designer: Belajar UI/UX Designer untuk
                                        pemula</h5>
                                    <p class="avatar m-0"><img src="{{ asset('nemolab/member/img/icon/Group 7.png') }}"
                                            alt="" /> Naufal
                                        Haidar Azhar</p>
                                </div>
                                <div class="btn-group-harga d-flex justify-content-between align-items-center mt-md-3">
                                    <div class="harga d-none d-md-block">
                                        <p class="p-0 m-0 fw-semibold">Harga</p>
                                        <p class="p-0 m-0 fw-semibold">Gratis</p>
                                    </div>
                                    <a href="detail-course.html" class="btn btn-primary">Mulai Belajar</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="d-flex justify-content-center mt-5 mt-md-0">
                    <a href="course.html" class="btn fw-bold d-md-none">Lihat Kelas Lainnya</a>
                </div>

            </div>
        </div>
    </section>
    <!-- end section 2 -->

    <!-- section 3 -->
    <section class="section-tentang-nemolab" id="section-tentang-nemolab">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6 justify-content-center d-none d-md-flex" id="service" data-aos="fade-up"
                    data-aos-delay="100">
                    <div class="col-9 d-flex align-items-center justify-content-center">
                        <img src="{{ asset('nemolab/member/img/lp-hero-2.png') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-3 d-flex flex-column justify-content-center mt-4" id="menu-service">
                        <div class="card-service mb-4 py-2" id="item-service" data-aos="zoom-out" data-aos-delay="200">
                            <h4 class="fw-bold">Video</h4>
                            <a href="course.html" class="btn btn-secondary py-1 px-2 mt-2">belajar sekarang</a>
                        </div>
                        <div class="card-service mb-4 py-2" id="item-service" data-aos="zoom-out" data-aos-delay="300">
                            <h4 class="fw-bold">E-book</h4>
                            <a href="course.html" class="btn btn-primary py-1 px-2 mt-2">belajar sekarang</a>
                        </div>
                        <div class="card-service mb-4 py-2" id="item-service" data-aos="zoom-out" data-aos-delay="400">
                            <h4 class="fw-bold">Video + E-book</h4>
                            <a href="course.html" class="btn btn-warning py-1 px-2 mt-2">belajar sekarang</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center text-md-start" data-aos="fade-up" data-aos-delay="200">
                    <!-- Added text-center for mobile -->
                    <h1 class="fw-bold">Mengapa Harus Belajar Keahlian Di Nemolab?</h1>
                    <p>Kamu bisa belajar berbagai macam keahlian di sini. Kami juga menyediakan kelas video dan
                        e-book
                        yang bisa menyesuaikan tipe pembelajaran kamu. Jadi, mulailah menjadi ahli dari sekarang!
                    </p>
                    <div class="link-href-group d-flex justify-content-center justify-content-md-start">
                        <!-- Center buttons on mobile -->
                        <a href="course.html" class="btn btn-primary fw-bold px-4 me-3 pt-2 pb-2" data-aos="fade-up"
                            data-aos-delay="300">Coba Kursus</a>
                        <a href="course.html" class="btn btn-secondary fw-bold px-4 pt-2 pb-2" data-aos="fade-up"
                            data-aos-delay="400">Coba Ebook</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section 3 -->

    <!-- section 4 -->
    <section class="section-benefit-kelas" id="section-benefit-kelas" data-aos="fade-up">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start">
                    <h1 class="fw-bold">Benefit Yang Bisa Kamu Dapatkan Jika Belajar Disini</h1>
                    <ul class="check-active-group mt-3 list-unstyled">
                        <!-- Changed to ul and added list-unstyled -->
                        <li class="check-active d-flex align-items-center" data-aos="zoom-out">
                            <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                            <p class="m-0 p-0 ms-2">Akses kelas selamanya</p>
                        </li>
                        <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out" data-aos-delay="100">
                            <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                            <p class="m-0 p-0 ms-2">Mendapat sertifikat pembelajaran resmi</p>
                        </li>
                        <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out" data-aos-delay="200">
                            <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                            <p class="m-0 p-0 ms-2">Grup diskusi private</p>
                        </li>
                        <li class="check-active d-flex mt-2 align-items-center" data-aos="zoom-out" data-aos-delay="300">
                            <img src="{{ asset('nemolab/member/img/check-active.png') }}" alt="Check">
                            <p class="m-0 p-0 ms-2">Konsultasi dengan mentor secara langsung</p>
                        </li>
                    </ul>
                    <a href="#" class="btn btn-primary px-4 mt-4">Gabung Kelas</a>
                </div>
                <div class="col-md-6 justify-content-center d-none d-md-flex" id="service" data-aos="fade-up"
                    data-aos-delay="100">
                    <div class="benefit-images d-flex my-3">
                        <div class="person-image">
                            <img src="{{ asset('nemolab/member/img/lp-person-1.png') }}" class="img-fluid"
                                alt="Person">
                        </div>
                        <div class="grid-images d-flex flex-wrap">
                            <img src="{{ asset('nemolab/member/img/lp-person-3.png') }}" class="grid-img" alt="Image 1"
                                data-aos="zoom-in" data-aos-delay="100">
                            <img src="{{ asset('nemolab/member/img/lp-person-2.png') }}" class="grid-img" alt="Image 2"
                                data-aos="zoom-in" data-aos-delay="200">
                            <img src="{{ asset('nemolab/member/img/lp-person-4.png') }}" class="grid-img" alt="Image 3"
                                data-aos="zoom-in" data-aos-delay="300">
                            <img src="{{ asset('nemolab/member/img/lp-person-5.png') }}" class="grid-img" alt="Image 4"
                                data-aos="zoom-in" data-aos-delay="400">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- end section 4 -->

    <!-- section 5 -->
    <section class="section-testimoni-kelas" id="section-testimoni-kelas" data-aos="fade-up">
        <div class="container-fluid">
            <div class="testimoni-title pb-5">
                <h1 class="fw-bold m-0">Selangkah Lebih Maju menjadi <br> Professional!!</h1>
                <p class="fs-6 mt-2">Jangan ragu untuk bergabung di kelas-kelas kami! Banyak pengguna <br> sudah
                    membuktikan dengan belajar di kelas kami</p>
                <a href="course.html" class="btn btn-primary px-4">Coba Kursus</a>
            </div>
            <div class="row p-0" id="testimonials">
                <div class="col-md-4 scroll-up">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/images-testimoni-one.png') }}" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Rahmat Hidayat Sianturi</h5>
                                        <p class="m-0">UI/UX Designer</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Kelas UI/UX ini memberi saya wawasan baru tentang
                                    cara
                                    memahami kebutuhan pengguna. Sempurna untuk meningkatkan skill desainmu!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/images-testimoni-two.png') }}" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Vindra Arya Yulian</h5>
                                        <p class="m-0">Frontend Develeoper</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Belajar Frontend di sini benar-benar mengubah cara
                                    saya mengembangkan aplikasi web. Materinya langsung bisa diterapkan ke proyek
                                    nyata!
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/images-testimoni-three.png') }}"
                                        alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Muhammad Fathur</h5>
                                        <p class="m-0">Wordpress Develeoper</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Dari kelas WordPress Development, saya sekarang
                                    bisa
                                    membuat dan mengelola website dengan mudah. Sangat membantu meningkatkan bisnis
                                    online
                                    saya!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 scroll-down">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/images-testimoni-for.png') }}" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Naufal Haidar Azhar</h5>
                                        <p class="m-0">UI/UX Designer</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Setelah mengikuti kursus UI/UX di sini, saya
                                    berhasil
                                    membuat desain yang lebih user-friendly. Ini sangat membantu karir saya sebagai
                                    desainer! Kamu harus coba!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/images-testimoni-five.png') }}"
                                        alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Vebrian Nikola Saputra</h5>
                                        <p class="m-0">Fullstack Developer</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Kelas Backend ini mengajarkan saya cara membuat
                                    sistem
                                    yang scalable dan aman. Cocok banget buat kamu yang ingin jadi developer
                                    profesional!
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card  mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/images-testimoni-six.png') }}" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Emilia Putri</h5>
                                        <p class="m-0">Graphic Design</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Kursus Graphic Design ini benar-benar membantu
                                    saya
                                    menghasilkan desain yang lebih menarik dan profesional. Materinya mudah
                                    dipahami,
                                    bahkan untuk pemula!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 scroll-up">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/images-testimoni-one.png') }}" alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Rizqy Bagus Saputra </h5>
                                        <p class="m-0">Backend Develeoper</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Setelah mengikuti kursus Backend, saya lebih
                                    percaya
                                    diri menangani proyek kompleks. Panduan yang jelas dan praktis membuat belajar
                                    jadi
                                    lebih mudah!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/images-testimoni-seven.png') }}"
                                        alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Duiki Arbiyan</h5>
                                        <p class="m-0">Frontend Develeoper</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Saya sekarang bisa membangun website interaktif
                                    dengan
                                    mudah setelah mengikuti kelas Frontend Development. Tools dan materi yang
                                    diberikan
                                    sangat lengkap!
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center ">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-head d-flex align-items-center">
                                    <img src="{{ asset('nemolab/member/img/images-testimoni-three.png') }}"
                                        alt="">
                                    <div class="name ms-3">
                                        <h5 class="card-title m-0 fw-bold">Abdul Somad</h5>
                                        <p class="m-0">Graphic Design</p>
                                    </div>
                                </div>
                                <p class="card-text p-0 m-0 mt-2">Dengan mengikuti kelas Graphic Design di sini,
                                    saya
                                    bisa mengembangkan portofolio yang membuat saya dilirik oleh perusahaan besar.
                                    Sangat direkomendasikan!
                                    online
                                    saya!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end section 5 -->

    <!-- section 6 -->
    <section class="section-pusat-bantuan" id="section-pusat-bantuan" data-aos="fade-up">
        <div class="row align-items-center mt-0">
            <div class="col-12 col-xl-6 order-2 order-xl-1 text-center text-xl-start mt-5 mt-xl-0" data-aos="fade-up"
                data-aos-delay="100">
                <h1 class="fw-bold">Hubungi Kami Jika Anda Memiliki Kendala</p>
                    <a href="#" class="btn btn-primary px-4 pt-2 pb-2 mt-2">Hubungi CS</a>
            </div>
            <div class="col-12 col-xl-6 order-1 order-xl-2 order-center">
                <img src="{{ asset('nemolab/member/img/lp-hero-4.png') }}" alt="" class="img-fluid">
            </div>
        </div>
    </section>
    <!-- end section 6 -->

@endsection

@push('addon-script')
    <script src="{{asset('nemolab/member/js/home.js')}}"></script>
@endpush

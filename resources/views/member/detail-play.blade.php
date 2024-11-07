@extends('components.layouts.member.app')

@section('title', 'Nemolab - Kursus Online')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/detail-play.css') }} ">
    @endpush

@section('content')

    <section class="detail-course-section" id="detail-course-section">
        <div class="container">
            <a href="javascript:void(0);" class="btn-back " onclick="window.history.back();">
                <img src="{{ asset('nemolab/member/img/arrow.png') }}" alt="Back" class="back-icon">
            </a>
            <h4 class="m-0 p-0 mt-5 mb-4 text-center">UI/UX Designer : Belajar UI/UX Designer lebih mudah dengan
                ChatGPT</h4>
            <div class="content-images d-flex justify-content-center">
                <img src="{{ asset('storage/images/covers/' . $courses->cover) }}" alt="">
            </div>
            <div class="subcontent-images mt-5">
                <div class="row">
                    <div class="col-4 mb-4">
                        <a href="{{ $courses->link_grup }}" class="shadow">
                            <img src="{{ asset('nemolab/member/img/img-diskusi.png') }}" alt="">
                            <div class="group-title-subtitle ms-3">
                                <p class="m-0 p-0">Grup Diskusi</p>
                                <p class="m-0 p-0">Gabung Grup Diskusi</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-4 mb-4">
                        <a href="#" class="shadow">
                            <img src="{{ asset('nemolab/member/img/img-achievement.png') }}" alt="">
                            <div class="group-title-subtitle ms-3">
                                <p class="m-0 p-0">Unduh Sertifikat</p>
                                <p class="m-0 p-0">Unduh Sertifikat Anda</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-4 mb-4">
                        <a href="{{ route('member.forum' , $courses->slug) }}" class="shadow">
                            <img src="{{ asset('nemolab/member/img/img-diskusi.png') }}" alt="">
                            <div class="group-title-subtitle ms-3">
                                <p class="m-0 p-0">Konsultasi Mentor</p>
                                <p class="m-0 p-0">Konsultasi Dengan Mentor</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-4 mb-4">
                        <a href="{{ $courses->resources }}" class="shadow">
                            <img src="{{ asset('nemolab/member/img/img-asset.png') }}" alt="">
                            <div class="group-title-subtitle ms-3">
                                <p class="m-0 p-0">Asset Belajar</p>
                                <p class="m-0 p-0">Unduh Asset disini</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            {{-- <div class="detail-courses mt-5">
                <div class="card">
                    <div class="card-header p-0">
                        <h5 class="m-0">Detail</h5>
                    </div>
                    <div class="card-body d-flex align-items-center p-0 pt-3">
                        <div class="text">
                            <p class="m-0 p-0">Tanggal rilis </p>
                            <p class="m-0 p-0">Jenis paket </p>
                            <p class="m-0 p-0">Jumlah Halaman</p>
                            <p class="m-0 p-0">Tingkatan </p>
                        </div>
                        <div class="text-titik-koma">
                            <p class="m-0 p-0 ms-3">:</p>
                            <p class="m-0 p-0 ms-3">:</p>
                            <p class="m-0 p-0 ms-3">:</p>
                            <p class="m-0 p-0 ms-3">:</p>
                        </div>
                        <div class="text-content">
                            <p class="m-0 p-0 ms-3">2 Oktober 2024</p>
                            <p class="m-0 p-0 ms-3">E-Book</p>
                            <p class="m-0 p-0 ms-3">80 halaman</p>
                            <p class="m-0 p-0 ms-3">Pemula</p>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="description-courses mt-5">
                <div class="card">
                    <div class="card-header p-0">
                        <h5 class="m-0">Deskripsi Kursus</h5>
                    </div>
                    <div class="card-body d-flex align-items-center p-0 pt-3">
                        <p class="m-0 p-0 ">{{ $courses->description }}</p>
                    </div>
                </div>
            </div>
            <div class="tools-courses mt-5">
                <div class="card">
                    <div class="card-header p-0">
                        <h5 class="m-0">Tools</h5>
                    </div>
                    <div class="card-body d-flex align-items-center p-0 pt-3">
                        @foreach ($coursetools->tools as $tool)
                        <div class="tools-group d-flex justify-content-center align-items-center flex-column">
                            <img src="assets/img/figma.png" alt="">
                            <p class="m-0 p-0 pt-1">{{ $tool->name_tools }}  </p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{-- <div class="testimoni mt-5">
                <h1>Testimoni</h1>
                <div class="col-12 mt-4">
                    <div class="row card-testimoni col-12">
                        <div class="col-6">
                            <div class="card mb-4 border-0">
                                <div class="card-body">
                                    <div class="card-head d-flex align-items-center">
                                        <img src="assets/img/images-testimoni-one.png" alt="">
                                        <div class="name ms-3">
                                            <h5 class="card-title m-0 fw-bold">Rahmat Tahalu</h5>
                                            <p class="m-0">UI/UX Designer</p>
                                        </div>
                                    </div>
                                    <p class="card-text p-0 m-0 mt-2">Pelatihan UI/UX ini memberikan saya pandangan
                                        baru
                                        mengenai cara memahami kebutuhan pengguna. Sangat tepat untuk mengasah
                                        keterampilan design!</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card mb-4 border-0">
                                <div class="card-body">
                                    <div class="card-head d-flex align-items-center">
                                        <img src="assets/img/images-testimoni-one.png" alt="">
                                        <div class="name ms-3">
                                            <h5 class="card-title m-0 fw-bold">Rahmat Hidayat Sianturi</h5>
                                            <p class="m-0">UI/UX Designer</p>
                                        </div>
                                    </div>
                                    <p class="card-text p-0 m-0 mt-2">Kelas UI/UX ini memberi saya wawasan baru
                                        tentang
                                        cara
                                        memahami kebutuhan pengguna. Sempurna untuk meningkatkan skill desainmu!</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card mb-4 border-0">
                                <div class="card-body">
                                    <div class="card-head d-flex align-items-center">
                                        <img src="assets/img/images-testimoni-two.png" alt="">
                                        <div class="name ms-3">
                                            <h5 class="card-title m-0 fw-bold">Vindra Arya Yulian</h5>
                                            <p class="m-0">Frontend Develeoper</p>
                                        </div>
                                    </div>
                                    <p class="card-text p-0 m-0 mt-2">Belajar Frontend di sini benar-benar mengubah
                                        cara
                                        saya mengembangkan aplikasi web. Materinya langsung bisa diterapkan ke
                                        proyek
                                        nyata!
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card mb-4 border-0">
                                <div class="card-body">
                                    <div class="card-head d-flex align-items-center">
                                        <img src="assets/img/images-testimoni-three.png" alt="">
                                        <div class="name ms-3">
                                            <h5 class="card-title m-0 fw-bold">Muhammad Fathur</h5>
                                            <p class="m-0">Wordpress Develeoper</p>
                                        </div>
                                    </div>
                                    <p class="card-text p-0 m-0 mt-2">Dari kelas WordPress Development, saya
                                        sekarang
                                        bisa
                                        membuat dan mengelola website dengan mudah. Sangat membantu meningkatkan
                                        bisnis
                                        online
                                        saya!
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card mb-4 border-0">
                                <div class="card-body">
                                    <div class="card-head d-flex align-items-center">
                                        <img src="assets/img/images-testimoni-for.png" alt="">
                                        <div class="name ms-3">
                                            <h5 class="card-title m-0 fw-bold">Naufal Haidar Azhar</h5>
                                            <p class="m-0">UI/UX Designer</p>
                                        </div>
                                    </div>
                                    <p class="card-text p-0 m-0 mt-2">Setelah mengikuti kursus UI/UX di sini, saya
                                        berhasil
                                        membuat desain yang lebih user-friendly. Ini sangat membantu karir saya
                                        sebagai
                                        desainer! Kamu harus coba!</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card mb-4 border-0">
                                <div class="card-body">
                                    <div class="card-head d-flex align-items-center">
                                        <img src="assets/img/images-testimoni-six.png" alt="">
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

                        <div id="additional-content" class="mt-3">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card mb-4 border-0">
                                        <div class="card-body">
                                            <div class="card-head d-flex align-items-center">
                                                <img src="assets/img/images-testimoni-one.png" alt="">
                                                <div class="name ms-3">
                                                    <h5 class="card-title m-0 fw-bold">Rizqy Bagus Saputra </h5>
                                                    <p class="m-0">Backend Develeoper</p>
                                                </div>
                                            </div>
                                            <p class="card-text p-0 m-0 mt-2">Setelah mengikuti kursus Backend, saya
                                                lebih
                                                percaya
                                                diri menangani proyek kompleks. Panduan yang jelas dan praktis
                                                membuat
                                                belajar
                                                jadi
                                                lebih mudah!</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card mb-4 border-0">
                                        <div class="card-body">
                                            <div class="card-head d-flex align-items-center">
                                                <img src="assets/img/images-testimoni-seven.png" alt="">
                                                <div class="name ms-3">
                                                    <h5 class="card-title m-0 fw-bold">Duiki Arbiyan</h5>
                                                    <p class="m-0">Frontend Develeoper</p>
                                                </div>
                                            </div>
                                            <p class="card-text p-0 m-0 mt-2">Saya sekarang bisa membangun website
                                                interaktif
                                                dengan
                                                mudah setelah mengikuti kelas Frontend Development. Tools dan materi
                                                yang
                                                diberikan
                                                sangat lengkap!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="navtabs-more-testimoni d-flex justify-content-center">
                        <button class="btn btn-primary px-4 pt-2 pb-2 " id="show-more-btn">
                            Lihat Lainnya
                        </button>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>
    <!-- end section 1 -->
@endsection
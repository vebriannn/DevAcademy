@extends('components.layouts.member.app')

@section('title', 'Landing Pages')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/home.css') }} ">
@endpush

@section('content')
    <!-- HOME -->
    <section class="pb-3 w-100" id="home" style="margin-top: 5rem">
        <div class="container">
            <div class="card card-home text-white p-0">
                <div class="card-body d-flex flex-column justify-content-center p-0">
                    <div class="row ">
                        <div class="col-lg-6 col-md-12 my-auto px-5 py-lg-0 py-md-4">
                            <p class="card-text fw-lighter mt-md-0 mt-sm-3">"Nemolab of Education"</p>
                            <p class="card-title fw-bolder">Mulailah Karier Impian Anda Bersama Kami</p>
                            <p class="card-text">Nemolab menawarkan kelas UI/UX Design, Web Development, dan Freelancer untuk
                                pemula, membantu Anda memulai karier dengan fondasi yang kuat dan keterampilan yang praktis.
                            </p>
                            <a href="#" class="btn-started d-inline-block px-4 mb-md-0 mb-sm-3 rounded-3">Get Started</a>
                        </div>
                        <div class="col-lg-6 d-none d-lg-block">
                            <img class="mx-auto float-end" src="{{ asset('nemolab/member/img/vero.png') }}"
                                style="width: 85%;" alt="">
                        </div>
                    </div>
                </div>
            </div>

            <ul class="d-flex mt-5 pb-5 mx-auto align-content-center justify-content-center tools">
                <li class="card card-tools p-2 ">
                    <div class="mx-auto d-flex justify-content-center my-auto">
                        <img class="figma" src="{{ asset('nemolab/member/img/figma.png') }}" alt="">
                        <h3 class="my-auto ps-3">UI/UX</h3>
                    </div>
                </li>
                <li class="card card-tools p-2 ">
                    <div class="mx-auto d-flex justify-content-center my-auto">
                        <img src="{{ asset('nemolab/member/img/Vscode.png') }}" alt="">
                        <h3 class="my-auto ps-3">Frontend</h3>
                    </div>
                </li>
                <li class="card card-tools p-2 ">
                    <div class="mx-auto d-flex justify-content-center my-auto">
                        <img src="{{ asset('nemolab/member/img/server.png') }}" alt="">
                        <h3 class="my-auto ps-3">Backend</h3>
                    </div>
                </li>
            </ul>
        </div>
    </section>

    <section id="course"class="container" style="height: max-content">
        <p class="text-center pt-4">Course</p>
        <h2 class="text-center fw-bolder">Our Course</h2>
        <p class="text-center pt-4 mx-auto deskripsi-course">Lörem ipsum astrobel sar direlig. Kronde est konfoni med
            kelig. Terabel pov astrobel sar direlig.Lörem ipsum astrobel sar direlig. Kronde est </p>
        <div class="row row-course mx-auto mt-5 px-5">
            <div class="col-lg-6 col-sm-12">
                <div class="card px-4 d-flex justify-content-end align-content-end image-course-1"
                    style=" height: 100%; border-radius: 24px;">
                    <div class="row">
                        <div class="col-lg-7 col-md-12">
                            <h2 class="card-title text-white">Website Design</h2>
                            <p class="card-text text-white mb-3 mt-xl-4 mt-lg-2 fw-lighter">Lörem ipsum astrobel sar
                                direlig. Kronde
                                est
                                konfoni med kelig. Terabel pov astrobel sar</p>
                        </div>
                        <div
                        class="col-lg-5 col-md-12 mb-lg-0 mb-md-4 d-lg-flex d-md-block justify-content-center align-content-center">
                        @if (Auth::check())
                            <a href="{{ route('member.course') }}" class="btn btn-join text-white bg-transparent my-auto">Join Us</a>
                        @else
                            <a href="{{ route('member.login') }}" class="btn btn-join text-white bg-transparent my-auto">Join Us</a>
                        @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12" style="height: 100%;">
                <div class="row d-flex" style="height: 100%;">
                    <div class="col-lg-12 col-sm-6 pb-2" style="height: 50%;">
                        <div class="card px-4 py-3 d-flex justify-content-end align-content-end image-course-2"
                            style="height: 100%; border-radius: 24px;">
                            <div class="row">
                                <div class="col-xl-7 col-lg-12">
                                    <h3 class="card-title text-white">Website Design</h3>
                                    <p class="card-text text-white mt-xl-2 fw-lighter">Lörem ipsum astrobel sar direlig.
                                        Kronde est
                                        konfoni
                                        med kelig. Terabel pov astrobel sar</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6 pt-2" style="height: 50%;">
                        <div class="card p-4 px-4 py-3 d-flex justify-content-end align-content-end image-course-3"
                            style="height: 100%; border-radius: 24px;">
                            <div class="row">
                                <div class="col-xl-7 col-lg-12">
                                    <h3 class="card-title text-white">Website Design</h3>
                                    <p class="card-text text-white mt-2 fw-lighter">Lörem ipsum astrobel sar direlig. Kronde
                                        est konfoni
                                        med kelig. Terabel pov astrobel sar</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center mt-5 pb-3">
            @if (Auth::check())
                <a href="{{ route('member.course') }}" class="btn-more fw-bolder d-inline-block mb-3 shadow-sm">Learn More</a>
            @else
                <a href="{{ route('member.login') }}" class="btn-more fw-bolder d-inline-block mb-3 shadow-sm">Learn More</a>
            @endif
        </div>
    </section>

    <section id="testimonial">
        <div class="container p-0">
            <p class="text-center text-gray">What our customer say</p>
            <h2 class="text-center mt-4 fw-bold" style="color: ;">Testimonial</h2>
            <p class="text-center text-gray mt-4">Lörem ipsum astrobel sar direlig. Kronde est konfoni med kelig.</p>
            <div class="row d-flex justify-content-center align-item-center row-marque">
                <!-- First marquee (scrolling up) -->
                <div class="marquee-container col-3 d-lg-flex flex-column d-sm-none first-marque">
                  <div class="scroll d-flex flex-column align-item-center justify-content-center">
                    <!-- Original set of cards -->
                    @foreach ($reviews as $review)
                    <div class="card card-testimonial p-4">
                        <div class="profile d-flex">
                            @if ($review->user->avatar)
                                <img src="{{ asset('storage/images/avatars/' . $review->user->avatar) }}"
                                    alt="">
                            @else
                                <img src="{{ asset('nemolab/member/img/profile-img.png') }}" alt="">
                            @endif
                            <p class="ms-2 my-auto text-white">{{ $review->user->name }}</p>
                        </div>
                        <div class="comment">
                            {{ $review->note }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
          
                <!-- Second marquee (scrolling down) -->
                <div class="marquee-container col-lg-3 col-sm-6 second-marque">
                  <div class="scroll-reverse mx-auto">
                    <!-- Original set of cards -->
                    @foreach ($reviews as $review)
                    <div class="card card-testimonial p-4">
                        <div class="profile d-flex">
                            @if ($review->user->avatar)
                                <img src="{{ asset('storage/images/avatars/' . $review->user->avatar) }}"
                                    alt="">
                            @else
                                <img src="{{ asset('nemolab/member/img/profile-img.png') }}" alt="">
                            @endif
                            <p class="ms-2 my-auto text-white">{{ $review->user->name }}</p>
                        </div>
                        <div class="comment">
                            {{ $review->note }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
          
                <!-- Third marquee (scrolling up) -->
                <div class="marquee-container col-lg-3 col-sm-6 d-flex flex-column third-marque">
                          <div class="scroll d-flex flex-column align-item-center justify-content-center">
                            <!-- Original set of cards -->
                            @foreach ($reviews as $review)
                            <div class="card card-testimonial p-4">
                                <div class="profile d-flex">
                                    @if ($review->user->avatar)
                                        <img src="{{ asset('storage/images/avatars/' . $review->user->avatar) }}"
                                            alt="">
                                    @else
                                        <img src="{{ asset('nemolab/member/img/profile-img.jpg') }}" alt="">
                                    @endif
                                    <p class="ms-2 my-auto text-white">{{ $review->user->name }}</p>
                                </div>
                                <div class="comment">
                                    {{ $review->note }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
          
                </div>
        </div>
    </section>

    <section id="aboutus" class="pb-5">
        <div class="container">
            <h1 class="text-center fw-bold mb-5">Mulailah Karier Impian Anda Bersama <br class="d-none d-xl-block"> <span
                    class="text-gradient">NEMOLAB</span></h1>
            <h5 class="fw-normal">Bergabunglah dengan kami di <span class="text-gradient">NEMOLAB</span> dan temukan
                keajaiban
                pendidikan. Mari kita
                memulai untuk me perjalanan pengetahuan, kreativitas, dan kemungkinan tak terbatas bersama.</h5>
            <br>
            <h5 class="fw-normal">Selamat datang di <span class="text-gradient">NEMOLAB</span>, tempat di mana perjalanan
                menuju karier impian Anda
                dimulai. Kami menawarkan pendidikan terbaik dalam UI/UX Design, Web Development, dan keterampilan
                Freelancer,
                yang dirancang khusus untuk pemula. Misi kami adalah memberdayakan Anda dengan fondasi yang kokoh dan
                keterampilan praktis untuk unggul di bidang pilihan Anda.</h5>
            <div class="info mt-5">
                <div class="row">
                    <div class="col-12">
                        <div class="stats-container">
                            <div class="stat stat-line">
                                15+
                                <div class="stat-label">Total Courses</div>
                            </div>
                            <div class="stat stat-line">
                                1,000+
                                <div class="stat-label">Members</div>
                            </div>
                            <div class="stat">
                                4+
                                <div class="stat-label">Member Active</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contactus" class="mt-5 py-4 px-5 container">
        <div class="row mt-3">
            <div class="col-lg-4 col-md-12">
                <h3 class="fw-bold">Contact Us</h3>
                <p>email, call, or fill out the form to find out how Nemolab
                    can solve your messaging problems.</p>
                <div class="card-contact py-3 px-4">
                    <img src="{{ asset('nemolab/member/img/whatsapp.png') }}" alt="">
                    <p class="mt-1 mb-0 contact-platform">Contact WhatsApp</p>
                    <p class="value-platform mb-0">WhatsApp : +62 813-9973-74343</p>
                </div>
                <div class="card-contact py-3 px-4 mt-4">
                    <img src="{{ asset('nemolab/member/img/white-instagram.png') }}" alt="">
                    <p class="mt-1 mb-0 contact-platform">Contact Instagram</p>
                    <p class="value-platform mb-0">Instagram : nemolab.studio</p>
                </div>
                <div class="card-contact py-3 px-4 my-4">
                    <img src="{{ asset('nemolab/member/img/email.png') }}" alt="">
                    <p class="mt-1 mb-0 contact-platform">Contact Email</p>
                    <p class="value-platform mb-0">Email : nemolab.studio@gmail.com</p>
                </div>
            </div>
            <div class="col-lg-1 d-none d-lg-block"></div>
            <div class="col-lg-7 col-md-12 ">
                <h3 class="fw-bold">Get in Touch</h3>
                <p>You can reach us anything</p>
                <div class="row">
                    <div class="col-6">
                        <div class="entryarea">
                            <input type="email" required>
                            <div class="labelline">Email</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="entryarea">
                            <input type="text" required>
                            <div class="labelline">Username</div>
                        </div>
                    </div>
                    <div class="col-12 mt-lg-3" style="height: 190px;">
                        <div class="entryarea">
                            <textarea name="" id="" required></textarea>
                            <div class="labelline-textarea">Message</div>
                        </div>
                    </div>
                </div>
                <a href="#" class="btn-kirim fw-semibold text-white rounded-3 my-4 float-start float-lg-end">Kirim Pesan</a>
            </div>
            <div class="col-1"></div>
        </div>
    </section>
@endsection

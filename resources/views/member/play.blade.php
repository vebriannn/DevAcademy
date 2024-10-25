@extends('components.layouts.member.app')

@section('title', 'Nemolab - Play Kursus')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/member/css/play.css') }} ">
@endpush

@section('content')
        <!-- section 1 -->
<section class="view-course-section" id="view-course-section">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <div class="col-8">
                <iframe width="100%" height="70%"
                    src="{{ $play->video }}"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
                </iframe>
                <h2 class="m-0 p-0 mt-3">
                    {{ $play->name }}
                </h2>
                <div class="link-group d-block mt-4">
                    {{-- <a href="#" class="btn btn-primary w-100">Belajar E-Book</a> --}}
                    <a href="{{ route('member.course.detail', $courses->slug) }}" class="btn btn-secondary w-100 mt-1">Detail Kelas</a>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-body overflow-scroll">
                        @foreach($chapters as $chapter)
                            <div class="content mb-5">
                                <h5 class="m-0 p-0">{{ $chapter->name }}</h5>
                                <div class="link-source mt-3">
                                    @foreach($chapter->lessons as $lesson)
                                        <div class="link d-flex align-items-center mb-3">
                                            <a href="{{ route('member.course.play', ['slug' => $slug, 'episode' => $lesson->episode]) }}" class="text-wrap flex-grow-1">
                                                {{ $lesson->name }}
                                            </a>
                                            @if($lesson->isComplete)
                                                <img src="{{ asset('assets/img/check-course.png') }}" alt="Completed">
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- review modal --}}
    {{-- @if ($checkReview == null)
            <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="wrapper-modal">
                                <h3 class="mx-auto">Ulasan dan rating</h3>
                                <form id="reviewForm" action="{{ route('member.review.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <input type="hidden" name="course_id" value="{{ $courses->id }}">
                                    <div class="rating">
                                        <input type="number" name="rating" hidden>
                                        <i class='bx bx-star star' style="--i: 0;"></i>
                                        <i class='bx bx-star star' style="--i: 1;"></i>
                                        <i class='bx bx-star star' style="--i: 2;"></i>
                                        <i class='bx bx-star star' style="--i: 3;"></i>
                                        <i class='bx bx-star star' style="--i: 4;"></i>
                                    </div>
                                    <textarea name="note" cols="30" rows="5" placeholder="Message"></textarea>
                                    <div class="btn-group">
                                        <button type="submit" class="tombol-rating">Kirim</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif --}}
</section>
@endsection

@push('addon-script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var reviewModal = new bootstrap.Modal(document.getElementById('reviewModal'));
            setTimeout(function() {
                reviewModal.show();
            }, 10000);

            const allStar = document.querySelectorAll('.rating .star');
            const ratingValue = document.querySelector('.rating input[name="rating"]');
            const submitButton = document.querySelector('.tombol-rating');
            let isSubmitting = false;

            allStar.forEach((item, idx) => {
                item.addEventListener('click', function() {
                    ratingValue.value = idx + 1;
                    allStar.forEach(i => {
                        i.classList.replace('bxs-star', 'bx-star');
                        i.classList.remove('active');
                    });
                    for (let i = 0; i <= idx; i++) {
                        allStar[i].classList.replace('bx-star', 'bxs-star');
                        allStar[i].classList.add('active');
                    }
                });
            });


            document.getElementById('reviewForm').addEventListener('submit', function(e) {
                e.preventDefault();

                if (isSubmitting) return;  

                isSubmitting = true;
                submitButton.disabled = true; 

                const formData = new FormData(this);
                fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        }
                    })
                    .then(response => response.json())
                    .then(data => {

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Review Berhasil Di Kirim'
                        });

   
                        reviewModal.hide();


                        this.reset();
                        allStar.forEach(i => {
                            i.classList.replace('bxs-star', 'bx-star');
                            i.classList.remove('active');
                        });

                        isSubmitting = false; 
                        submitButton.disabled = false;  
                    })
                    .catch(error => {
                        console.error('Error:', error);

                    
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Something went wrong!'
                        });

                        isSubmitting = false;  
                        submitButton.disabled = false;  
                    });
            });

            $('#reviewModal').on('hidden.bs.modal', function() {
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
            });
        });

    </script>
@endpush

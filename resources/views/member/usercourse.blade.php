@extends('components.layouts.member.course')

@section('title, nemolab')

@section('content-course')
    <!-- CONTENT -->
    <div class="container-sm ">
        <div class="container position-fixed w-100">
            <div class="alert alert-warning alert-dismissible fade show text-black" role="alert">
                Ingin jadi Mentor? klik <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
                    class="disini text-decoratiom-none text-black px-2 py-1"> Disini</a>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>

        <!-- alert -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menjadi mentor?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <button type="button" class="btn-alert">Yes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-sm pt-3 pb-3" style="height: auto; margin-top: 120px;">
            <div class="content2 row top justify-content-between mx-auto mt-1" style="width: 95%;">
                <div class="dropdown">
                    <a class="dropdown-toggle text-black fs-5" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Category
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">ALL</a></li>
                        <li><a class="dropdown-item" href="#">Design Grafis</a></li>
                        <li><a class="dropdown-item" href="#">UI/UX Design</a></li>
                        <li><a class="dropdown-item" href="#">Designer Web</a></li>
                        <li><a class="dropdown-item" href="#">Soft Skills</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="card-category d-flex flex-column full-width-border">
                        <p class="mx-auto text-center pt-2 pb-1 border-bottom mt-3 mb-4">Category</p>
                        <div class="checkbox ms-3">
                            @foreach ($sortedCategory as $item)
                                <div class="form-check">
                                    <input class="form-check-input radiofilter" type="radio"
                                        id="radiofilter-{{ $loop->iteration }}">
                                    <label class="form-check-label" for="radiofilter-{{ $loop->iteration }}">
                                        {{ $item->name }}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-md-7 col-sm-12 row d-flex mx-auto overflow-y-scroll" id="course-container"
                    style="height: auto;">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        // variabel
        const btnRadio = document.querySelectorAll('.radiofilter');

        const starImagePath = "{{ asset('nemolab/assets/image/star.png') }}";
        const lessonImagePath = "{{ asset('nemolab/assets/image/lesson.png') }}";
        const hourseImagePath = "{{ asset('nemolab/assets/image/hours.png') }}";
        var query = "all";

        getDataCourse();

        // check radio aktif
        btnRadio.forEach(btn => {
            if (btn.checked == false) {
                btnRadio[0].checked = true
            }
            btn.addEventListener('click', function() {
                btnRadio.forEach(radio => {
                    radio.checked = false;
                })
                this.checked = true;

                // ubah value query
                query = query = document.querySelector(`label[for="${this.id}"]`).textContent;
                getDataCourse();
            })
        });

        function getDataCourse() {
            fetch('http://127.0.0.1:8000/api/v1/course/category?q=' + query)
                .then(response => response.json())
                .then(data => {
                    const courses = data.data;
                    const courseContainer = document.getElementById('course-container');

                    // Menghapus semua elemen anak dari courseContainer
                    courseContainer.innerHTML = '';

                    courses.forEach(courseData => {
                        courseData.course.forEach(course => {
                            const courseElement = document.createElement('div');
                            courseElement.className =
                                'col-xl-4 col-lg-6 col-md-12 col-sm-12 mb-lg-4 m-mobile first-card';
                            courseElement.innerHTML = `
                                <a href="#" data-course-id="${course.id_course}" onclick="setCourseUrl(this)">
                                    <div class="card-course">
                                        <img src="${course.cover_course}" class="img-card" alt="${course.title_course}">
                                        <div class="container-card px-3 mt-2">
                                            <p class="produck-title text-black mb-0" style="margin-top: -10px;">${course.category_course}:</p>
                                            <p class="produck-title text-black" style="">${course.title_course}</p>
                                            <div class="profile-card d-flex mt-lg-3 mt-sm-0">
                                                <a href="" class="img-a my-auto">
                                                    <img src="${courseData.avatars_mentor}" alt="${courseData.name_mentor}" class="card-img-profile" style="border-radius: 100%;">
                                                </a>
                                                <a href="$" class="kurung text-a text-decoration-none">
                                                    <p class="profile-mentor text-black my-2">${courseData.name_mentor}</p>
                                                </a>
                                            </div>
                                            <div class="price mt-1">
                                                <p class="text-black mb-0 fw-lighter">Rp. ${course.price_course}</p>
                                            </div>
                                            <div class="status d-flex">
                                                <div class="left d-flex">
                                                    <img src="http://127.0.0.1:8000/nemolab/assets/image/lesson.png" alt="">
                                                    <p class="text-black mb-0 ms-1">1 Lesson</p>
                                                    <img src="http://127.0.0.1:8000/nemolab/assets/image/hours.png" style="height: 20px; margin-top: -1px; margin-left: 10px;" alt="">
                                                    <p class="text-black mb-0 ms-1">1 Hours</p>
                                                </div>
                                                <div class="right d-flex">
                                                    <img src="http://127.0.0.1:8000/nemolab/assets/image/star.png" style="height: 20px; margin-top: -1px;" alt="">
                                                    <p class="text-black mb-0 ms-1">4,6</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>`;
                            courseContainer.appendChild(courseElement);
                        });
                    });
                })
                .catch(error => console.error('Error fetching courses:', error));
        }

        function setCourseUrl(element) {
            var courseId = element.getAttribute('data-course-id');
            var url = "{{ route('member.course.join', ':id_course') }}";
            url = url.replace(':id_course', courseId);
            window.location.href = url;
        }
    </script>
@endsection

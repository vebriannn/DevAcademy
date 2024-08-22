@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Edit Course')

@section('content')

    <div class="card w-75 mt-5 mb-5" style="border: none !important;">
        <div class="card-header d-flex justify-content-between bg-transparent pb-0" style="border: none !important;">
            <h2 class="fw-semibold fs-4 mb-4" style="color: #faa907">Edit Data</h2>
            <a href="{{ route('admin.course') }}" class="btn btn-orange"> Back </a>
        </div>
        <div class="card-body pt-2">
            <form class="col-12" action="{{ route('admin.course.edit.update', $course->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-6">
                        <div class="custom-entryarea">
                            <select id="category" name="category">
                                @forelse ($category as $item)
                                    <option value="{{ $item->name }}"
                                        {{ $item->name == $course->category ? 'selected' : '' }}> {{ $item->name }}
                                    </option>
                                @empty
                                    <option value="">Tidak Ada Kategori</option>
                                @endforelse
                            </select>
                            @error('category')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="entryarea">
                            <input type="text" id="name" name="name" placeholder=""
                                value="{{ $course->name }}" />
                            <div class="labelline" for="name">Title</div>
                            @error('name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="entryarea">
                            <textarea id="description" name="description" placeholder="" style="height: 173px">{{ $course->description }}</textarea>
                            <div class="labelline-textarea" for="desc">Description</div>
                            @error('description')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="custom-entryarea">
                            <select id="category" name="status">
                                <option value="draft" {{ $course->status == 'draft' ? 'selected' : '' }}>draft</option>
                                <option value="published" {{ $course->status == 'published' ? 'selected' : '' }}>published
                                </option>
                            </select>
                            @error('status')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="custom-entryarea">
                            <select id="type" name="type">
                                <option value="free" {{ $course->type == 'free' ? 'selected' : '' }}>Free</option>
                                <option value="premium" {{ $course->type == 'premium' ? 'selected' : '' }}>Premium</option>
                            </select>
                            @error('type')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-none" id="price">
                        <div class="entryarea">
                            <input type="text" id="link" name="price" placeholder=" "
                                value="{{ $course->price }}">
                            <div class="labelline" for="link">Price</div>
                            @error('price')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
<<<<<<< Updated upstream:resources/views/admin/coursesvideo/update.blade.php
                    <div class="col-6">
=======
                    <div class="col-12 mb-4" id="upImages">
                        <input type="file" id="imageUpload" name="cover" accept="image/*" class="custom-file-input" />
                        <label for="imageUpload" class="custom-file-label">Choose File</label>
                        @error('cover')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12">
>>>>>>> Stashed changes:resources/views/admin/courses/update.blade.php
                        <div class="custom-entryarea">
                            <select id="category" name="level">
                                <option value="beginner" {{ $course->level == 'beginner' ? 'selected' : '' }}>Beginner
                                </option>
                                <option value="intermediate" {{ $course->level == 'intermediate' ? 'selected' : '' }}>
                                    Intermediate</option>
                                <option value="expert" {{ $course->level == 'expert' ? 'selected' : '' }}>Expert</option>
                            </select>
                            @error('level')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="custom-entryarea">
                            <input type="text" id="link" name="link" placeholder=" " />
                            <div class="labelline" for="link">Link</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <input type="file" id="imageUpload" name="cover" accept="image/*" class="custom-file-input" />
                        <label for="imageUpload" class="custom-file-label">Choose File</label>
                        @error('cover')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <button type="submit"
                            class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white fw-semibold btn-kirim"
                            style="background-color: #faa907">Kirim</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('addon-script')
    <script>
        const type = document.getElementById('type');
        const price = document.getElementById('price');
        const uploadImages = document.getElementById('upImages');

        type.addEventListener('change', (e) => {
            if (e.target.value == 'premium') {
                price.classList.remove('d-none')
                price.classList.add('d-block')

                uploadImages.classList.remove('col-12')
                uploadImages.classList.add('col-6')

            } else {
                price.classList.remove('d-block')
                price.classList.add('d-none')

                uploadImages.classList.remove('col-6')
                uploadImages.classList.add('col-12')

                price.querySelector('input[name="price"]').setAttribute('value', '0');
            }
        })

    </script>
@endpush

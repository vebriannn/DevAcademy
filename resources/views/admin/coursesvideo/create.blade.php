@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Create Course')

@section('content')
    <div class="card w-75 mt-5 mb-5" style="border: none !important;">
        <div class="card-header d-flex justify-content-between bg-transparent pb-0" style="border: none !important;">
            <h2 class="fw-semibold fs-4 mb-4" style="color: #faa907">Tambah Data</h2>
            <a href="{{ route('admin.course') }}" class="btn btn-orange"> Back </a>
        </div>
        <div class="card-body pt-2">
            <form class="col-12" id="formAction" action="{{ route('admin.course.create.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="custom-entryarea">
                            <select id="category" name="category">
                                @forelse ($category as $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
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
                            <input type="text" id="name" name="name" placeholder="" />
                            <div class="labelline" for="name">Title</div>
                            @error('name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="entryarea">
                            <textarea id="description" name="description" placeholder="" style="height: 173px"></textarea>
                            <div class="labelline-textarea" for="desc">Description</div>
                            @error('description')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="custom-entryarea">
                            <select id="category" name="status">
                                <option value="draft">draft</option>
                                <option value="published">published</option>
                            </select>
                            @error('status')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="custom-entryarea">
                            <select id="type" name="type">
                                <option value="free" class="value_type">Free</option>
                                <option value="premium" class="value_type">Premium</option>
                            </select>
                            @error('type')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="entryarea d-none" id="price">
                            <input type="text" name="price" value="">
                            <div class="labelline" for="link">Price</div>
                            @error('price')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 mb-4" id="upImages">
                        <input type="file" id="imageUpload" name="cover" accept="image/*" class="custom-file-input" />
                        <label for="imageUpload" class="custom-file-label">Choose File</label>
                        @error('cover')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <p class="m-0 mb-1">Pilih Tools</p>
                    <div class="col-12 d-block mb-3">
                        @if ($tools->isNotEmpty())
                            <div class="d-flex align-items-center">
                                @foreach ($tools as $tool)
                                    <div class="form-check d-flex align-items-center ms-2">
                                        <input class="form-check-input p-0 p-2 border-0"
                                            style="float: none; border: 2px solid #faa907 !important;" type="checkbox"
                                            value="{{ $tool->id }}" id="flexCheckDefault" name="tools[]">
                                        <label class="form-check-label ms-2" for="flexCheckDefault">
                                            {{ $tool->name_tools }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            @error('tools')
                                <p class="m-0 text-danger d-block mb-3">
                                    {{ $message }}
                                </p>
                            @enderror
                        @else
                            <p class="m-0 text-danger">
                                @if ($errors->has('tools'))
                                    {{ $errors->first('tools') }}
                                @else
                                    Maaf Tools Course Belum Tersedia, Silahkan Untuk Buat Tools Terlebih Dahulu
                                @endif
                            </p>
                        @endif
                    </div>

                    <div class="col-12">
                        <div class="custom-entryarea">
                            <select id="category" name="level">
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="expert">Expert</option>
                            </select>
                            @error('level')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
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

        price.querySelector('input[name="price"]').setAttribute('value', '0'); // Ganti dengan nilai yang diinginkan

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

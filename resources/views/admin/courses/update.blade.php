@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create.css') }}">
@endpush

@section('title', 'Edit Course')

@section('content')

    <div class="card w-75 mt-5 mb-5" style="border: none !important;">
        <div class="card-header d-flex justify-content-between bg-transparent pb-0" style="border: none !important;">
            <h2 class="fw-semibold fs-4 mb-4" style="color: #faa907">Edit Data</h2>
            <a href="{{ route('admin.course') }}" class="btn btn-orange"> Back </a>
        </div>
        <div class="card-body pt-2">
            <form class="col-12" action="{{ route('admin.course.edit.update', $course->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-6">
                        <div class="custom-entryarea">
                            <select id="category" name="category">
                                @forelse ($category as $item)
                                    <option value="{{ $item->name }}"  {{ $item->name == $course->category ? 'selected' : '' }}> {{ $item->name }}</option>
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
                            <input type="text" id="name" name="name" placeholder="" value="{{ $course->name }}"/>
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
                            <select id="category" name="type">
                                <option value="free" {{ $course->type == 'free' ? 'selected' : '' }}>Free</option>
                                <option value="premium" {{ $course->type == 'premium' ? 'selected' : '' }}>Premium</option>
                            </select>
                            @error('type')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="entryarea">
                            <input type="text" id="link" name="price" placeholder=" " value="{{$course->price}}">
                            <div class="labelline" for="link">Price</div>
                            @error('price')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
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
                        <div class="custom-entryarea">
                            <select id="category" name="level">
                                <option value="beginner" {{ $course->level == 'beginner' ? 'selected' : '' }}>Beginner</option>
                                <option value="intermediate" {{ $course->level == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                <option value="expert" {{ $course->level == 'expert' ? 'selected' : '' }}>Expert</option>
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

{{-- @push('addon-script')
    <script>
        document.getElementById('sidebar-id').remove();
        document.getElementById('navbar-id').remove();
    </script>
@endpush --}}

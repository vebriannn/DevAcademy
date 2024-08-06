@extends('components.layouts.superadmin.edit')

@section('title, editdatacourse')

@section('content-editdatacourses')
    <div class="container mt-3 mb-3 p-5">
        <h2>Edit Data</h2>
        <div class="row mt-5">
            <img id="preview" src="{{ $courses->cover }}" alt="Image" class="img-fluid col-4 py-2">
            <form class="col-8" action="{{ route('admin.course.edit.update', $courses->id) }}" method="post" enctype="multipart/form-data">
                <div class="row mt-5">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-6">
                            <div class="entryarea">
                                <select id="category" name="category" required>
                                    @foreach ($category as $item)
                                        <option value="{{ $item->name }}"
                                            {{ $courses->category == $item->name ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="entryarea">
                                <input type="text" id="title" name="name" placeholder=" " required
                                    value="{{ $courses->name }}">
                                <div class="labelline" for="title">title</div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <div class="entryarea">
                                <input type="text" id="link" name="price" placeholder=" " required
                                    value="{{ $courses->price }}">
                                <div class="labelline" for="link">price</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col-6">
                                <div class="entryarea">
                                    <select id="category" name="status" required>
                                        <option value="draft" {{ $courses->status == 'draft' ? 'selected' : '' }}>draft
                                        </option>
                                        <option value="published" {{ $courses->status == 'published' ? 'selected' : '' }}>
                                            published</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="entryarea">
                                <select id="category" name="level" required>
                                    <option value="beginner" {{ $courses->level == 'beginner' ? 'selected' : '' }}>Beginner
                                    </option>
                                    <option value="intermediate" {{ $courses->level == 'intermediate' ? 'selected' : '' }}>
                                        Intermediate</option>
                                    <option value="expert" {{ $courses->level == 'expert' ? 'selected' : '' }}>Expert
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="entryarea">
                                <input type="file" id="image" name="cover" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="textarea">
                                <textarea id="description" name="description" placeholder=" " required>{{ $courses->description }}
                                    </textarea>
                                <div class="labelline-textarea" for="description">Description</div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <di class="col-12">
                            <div class="entryarea">
                                <select id="category" name="type" required>
                                    <option value="free" {{ $courses->type == 'free' ? 'selected' : '' }}>Free</option>
                                    <option value="premium" {{ $courses->type == 'premium' ? 'selected' : '' }}>Premium
                                    </option>
                                </select>
                            </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-2">
                        <button class="btn-kirim text-decoration-none" type="submit">Simpan</button>
                    </div>
                    <div class="col-2">
                        <a class="btn-batal text-decoration-none" href="#">Batalkan</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

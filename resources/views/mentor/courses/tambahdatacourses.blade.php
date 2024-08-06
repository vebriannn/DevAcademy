@extends('components.layouts.superadmin.edit')

@section('title, tambahdatacourse')

@section('content-tambahdatacourses')
    <div class="container mt-3 mb-3 p-5">
        <h2>Tambah Data</h2>
        <div class="row mt-5">
            <img id="preview" src="https://via.placeholder.com/150" alt="Image" class="img-fluid col-4 py-2">
            <form class="col-8" action="{{ route('admin.course.create.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="entryarea">
                            <select id="category" name="category" required>
                                @foreach ($category as $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="entryarea">
                            <input type="text" id="title" name="name" placeholder=" " required>
                            <div class="labelline" for="title">Title</div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="entryarea">
                            <input type="text" id="link" name="price" placeholder=" " required>
                            <div class="labelline" for="link">Price</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="col-6">
                            <div class="entryarea">
                                <select id="category" name="status" required>
                                    <option value="draft">draft</option>
                                    <option value="published">published</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="entryarea">
                            <select id="category" name="level" required>
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="expert">Expert</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="entryarea">
                            <input type="file" id="image" name="cover" accept="image/*" required>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="textarea">
                            <textarea id="description" name="description" placeholder=" " required></textarea>
                            <div class="labelline-textarea" for="description">Description</div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <di class="col-12">
                        <div class="entryarea">
                            <select id="category" name="type" required>
                                <option value="free">Free</option>
                                <option value="premium">Premium</option>
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

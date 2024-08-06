@extends('components.layouts.superadmin.dashboard')

@section('title, data-lesson')

@section('content-data-lessson')
    <div class="container mt-3 mb-3 p-5">
        <h2>Edit Data</h2>
        <div class="row mt-5">
            <form class="col-12" action="{{ route('admin.lesson.edit.update', $lessons->id) }}" method="post"
                enctype="multipart/form-data">
                <div class="row mt-5">
                    @csrf
                    @method('put')
                    <div class="col-6">
                        <div class="entryarea">
                            <input type="text" id="title" name="name" placeholder=" " required
                                value="{{ $lessons->name }}">
                            <div class="labelline" for="title">title</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="entryarea">
                            <input type="text" id="title" name="video" placeholder=" " required
                                value="{{ $lessons->video }}">
                            <div class="labelline" for="title">video</div>
                        </div>
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

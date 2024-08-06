@extends('components.layouts.superadmin.dashboard')

@section('title, data-chapter')

@section('content-data-chapter')
    <div class="container mt-3 mb-3 p-5">
        <h2>Tambah Data</h2>
        <div class="row mt-5">
            <form class="col-12" action="{{ route('admin.chapter.create.store', $id) }}" method="post"
                enctype="multipart/form-data">
                <div class="row mt-5">
                    @csrf
                        <div class="col-6">
                            <div class="entryarea">
                                <input type="text" id="title" name="name" placeholder=" " required>
                                <div class="labelline" for="title">title</div>
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

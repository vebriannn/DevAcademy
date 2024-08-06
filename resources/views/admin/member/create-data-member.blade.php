@extends('components.layouts.member.edittambah')

@section('title, tambahmember')

@section('content-create-data-member')

<div class="container mt-3 mb-3 p-5 w-75">
    <h2>Tambah Data</h2>
    <div class="d-flex mt-5 gap-4">
        <form class="col-12" action="/update-data" method="post" enctype="multipart/form-data">
            <div class="row d-flex">
                <div class="col-12 px-2">
                    <div class="entryarea">
                        <input type="number" id="title" name="title" placeholder=" " required>
                        <div class="labelline" for="title">Nama</div>
                    </div>
                </div>
            </div>
            <div class="row d-flex mt-3">
                <div class="col-6 px-2">
                    <div class="entryarea">
                        <input type="number" id="link" name="link" placeholder=" " required>
                        <div class="labelline" for="link">Email</div>
                    </div>
                </div>
                <div class="col-6 px-2">
                    <div class="entryarea">
                        <input type="number" id="link" name="link" placeholder=" " required>
                        <div class="labelline" for="link">Password</div>
                    </div>
                </div>
            </div>
            <div class="row d-flex mt-3">
                <div class="col-6 px-2">
                    <a class="btn-kirim text-decoration-none text-center rounded-4 w-100" href="#">Simpan Perubahan</a>
                </div>
                <div class="col-6 px-2">
                    <a class="btn-batal text-decoration-none text-center rounded-4 w-100" href="#">Batalkan</a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
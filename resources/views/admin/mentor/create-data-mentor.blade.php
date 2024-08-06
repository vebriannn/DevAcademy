@extends('components.layouts.member.edittambah')

@section('title, tambahsuperadmin')

@section('content-create-data-mentor')

<div class="container mt-3 mb-3 p-5 w-75">
    <h2>Tambah Data</h2>
    <div class="mt-5 gap-4">
        <form class="col-12" action="/update-data" method="post" enctype="multipart/form-data">
            <div class="row ">
                <div class="col-12 px-2">
                    <div class="entryarea">
                        <input type="number" id="title" name="title" placeholder=" " required>
                        <div class="labelline" for="title">Nama</div>
                    </div>
                </div>
                <div class="col-12 px-2">
                    <div class="entryarea">
                        <input type="number" id="title" name="title" placeholder=" " requirged>
                        <div class="labelline" for="title">Email</div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-6 px-2">
                    <div class="entryarea">
                        <input type="number" id="link" name="link" placeholder=" " required>
                        <div class="labelline" for="link">Password</div>
                    </div>
                </div>
                <div class="col-6 px-2">
                    <div class="entryarea">
                        <input type="number" id="link" name="link" placeholder=" " required>
                        <div class="labelline" for="link">Confirm Password</div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
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
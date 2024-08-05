@extends('components.layouts.superadmin.edit')

@section('title, data-course-admin')

@section('content-data-course-admin')
<div class="container mt-3 mb-3 p-5">
    <h2>Edit Data</h2>
    <div class="d-flex mt-5">
        <img id="preview" src="https://via.placeholder.com/150" alt="Image" class="img-fluid col-4 py-2">
        <form class="w-75 col-8" action="/update-data" method="post" enctype="multipart/form-data">
            <div class="d-flex">
                <div class="col-6">
                    <div class="entryarea">
                        <input type="number" id="title" name="title" placeholder=" " required>
                        <div class="labelline" for="title">Title</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="entryarea">
                        <select id="category" name="category" required>
                            <option value="" disabled selected>Pilih Kategori</option>
                            <option value="kategori1">Kategori 1</option>
                            <option value="kategori2">Kategori 2</option>
                            <option value="kategori3">Kategori 3</option>
                        </select>
                        <div class="labelline" for="category">Kategori</div>
                    </div>
                </div>
            </div>
            <div class="d-flex mt-3">
                <div class="col-6">
                    <div class="entryarea">
                        <input type="number" id="link" name="link" placeholder=" " required>
                        <div class="labelline" for="link">Link</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="entryarea">
                        <input type="file" id="image" name="image" accept="image/*" required>
                    </div>
                </div>
            </div>
            <div class="d-flex mt-3">
                <div class="col-12">
                    <div class="textarea">
                        <textarea id="description" name="description" placeholder=" " required></textarea>
                        <div class="labelline-textarea" for="description">Description</div>
                    </div>
                </div>
            </div>
            <div class="d-flex mt-3">
                <div class="col-2">
                    <a class="btn-kirim text-decoration-none" href="#">Simpan</a>
                </div>
                <div class="col-2">
                    <a class="btn-batal text-decoration-none" href="#">Batalkan</a>
                </div>
            </div>
        </form>
    </div>
</div>

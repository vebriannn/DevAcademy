@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Create eBook')

@section('content')
    <div class="card w-75 mt-5 mb-5" style="border: none !important;">
        <div class="card-header d-flex justify-content-between bg-transparent pb-0" style="border: none !important;">
            <h2 class="fw-semibold fs-4 mb-4" style="color: #faa907">Tambah eBook</h2>
            <a href="{{ route('admin.ebook') }}" class="btn btn-orange"> Kembali </a>
        </div>
        <div class="card-body pt-2">
            <form class="col-12" action="{{ route('admin.ebook.create.store') }}" method="post" enctype="multipart/form-data">
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
                            <div class="labelline" for="name">Judul</div>
                            @error('name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="entryarea">
                            <textarea id="description" name="description" placeholder="" style="height: 173px"></textarea>
                            <div class="labelline-textarea" for="description">Deskripsi</div>
                            @error('description')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="col-6 mb-3">
                        <p class="m-0">Sampul</p>
                        <input type="file" id="imageUpload" name="cover" accept="image/*" class="" />
                        @error('cover')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    <div class="col-12 mb-3">
                        <p class="m-0">File Pdf</p>
                        <input type="file" name="source_ebook" class="" />
                        @error('source_ebook')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-6 mt-2">
                        <div class="custom-entryarea">
                            <select id="status" name="status">
                                <option value="draft">Draf</option>
                                <option value="published">Publik</option>
                            </select>
                            @error('status')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 mt-2">
                        <div class="custom-entryarea">
                            <select id="type" name="type">
                                <option value="free" class="value_type">Gratis</option>
                                <option value="premium" class="value_type">Berbayar</option>
                            </select>
                            @error('type')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6 d-none" id="price">
                        <div class="entryarea">
                            <input type="number" id="name" name="price" placeholder="" value="0" />
                            <div class="labelline" for="link">Harga</div>
                            @error('price')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    {{-- <div class="col-12" id="fields-link">
                        <div class="entryarea">
                            <input type="text" id="link" name="link" placeholder=" " />
                            <div class="labelline" for="link">Link</div>
                            @error('link')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> --}}
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
        const link = document.getElementById('fields-link');

        type.addEventListener('change', (e) => {
            if (e.target.value == 'premium') {
                price.classList.replace('d-none', 'd-block');
                link.classList.replace('col-12', 'col-6');
            } else if (e.target.value == 'free') {
                price.classList.replace('d-block', 'd-none');
                link.classList.replace('col-6', 'col-12');
                price.querySelector('input[name="price"]').value = '0';
            }
        });
    </script>
@endpush

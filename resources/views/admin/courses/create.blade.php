@extends('components.layouts.admin.form')

@section('title', 'Tambahkan Kelas')

@push('styles')
    <style>
        .ck-editor__editable {
            min-height: 200px;
        }
    </style>
@endpush

@section('content')
    <div id="content" class="d-flex align-items-center justify-content-center" style="height: max-content; padding: 30px 0;">
        <div class="col-12 col-sm-6" style="margin-top: 3rem;">
            <div class="card p-4 shadow">
                <h4 class="text-primary fw-bold mb-4">Form Kelas</h4>
                <form method="POST" action="{{ route('admin.course.create.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label class="form-label">Pilih Kategori</label>
                        @if ($categories->isEmpty())
                            <div class="alert alert-danger">
                                Data kategori tidak tersedia. Harap tambahkan kategori terlebih dahulu.
                            </div>
                        @else
                            <div class="radio-groups d-flex align-items-center flex-wrap">
                                @foreach ($categories as $category)
                                    <div>
                                        <input type="radio" id="category-{{ $category->id }}" name="category"
                                            value="{{ $category->name }}"
                                            {{ old('category') == $category->name ? 'checked' : '' }}>
                                        <label for="category-{{ $category->id }}"
                                            class="m-0 p-0 mr-sm-3">{{ $category->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @error('category')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Nama Kelas -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Kelas</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Masukan Nama Kelas" value="{{ old('name') }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Cover -->
                    <div class="mb-3">
                        <label for="imageUpload" class="form-label">Upload Cover Kelas</label>
                        <input type="file" class="form-control @error('cover') is-invalid @enderror" id="imageUpload"
                            accept="image/*" name="cover">
                        @error('cover')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tools -->
                    <div class="mb-3">
                        <label class="form-label">Pilih Tools</label>
                        @if ($tools->isEmpty())
                            <div class="alert alert-danger">
                                Data tools tidak tersedia. Harap tambahkan tools terlebih dahulu.
                            </div>
                        @else
                            <div class="checkbox-groups d-flex align-items-center flex-wrap">
                                @foreach ($tools as $tool)
                                    <div>
                                        <input type="checkbox" id="tool-{{ $tool->id }}" name="tools[]"
                                            value="{{ $tool->id }}"
                                            {{ in_array($tool->id, old('tools', [])) ? 'checked' : '' }}>
                                        <label for="tool-{{ $tool->id }}"
                                            class="m-0 p-0 mr-sm-3">{{ $tool->name_tools }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @error('tools')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tipe & Status -->
                    <div class="row">
                        <div class="col-12 col-lg-6 mb-3">
                            <label class="form-label">Pilih Tipe</label>
                            <div class="radio-groups d-flex align-items-center" style="gap: 1rem;">
                                <div>
                                    <input type="radio" id="free" name="type" value="free"
                                        {{ old('type') == 'free' ? 'checked' : '' }} onclick="togglePrice(false)"
                                        {{ old('type') == 'free' ? 'checked' : '' }}>
                                    <label for="free">Gratis</label>
                                </div>
                                <div>
                                    <input type="radio" id="premium" name="type" value="premium"
                                        {{ old('type') == 'premium' ? 'checked' : '' }} onclick="togglePrice(true)"
                                        {{ old('type') == 'premium' ? 'checked' : '' }}>
                                    <label for="premium">Berbayar</label>
                                </div>
                            </div>
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-12 col-lg-6 mb-3">
                            <label class="form-label">Status</label>
                            <div class="radio-groups d-flex align-items-center" style="gap: 1rem;">
                                <div>
                                    <input type="radio" id="draft" name="status" value="draft"
                                        {{ old('status') == 'draft' ? 'checked' : '' }}>
                                    <label for="draft">Draf</label>
                                </div>
                                <div>
                                    <input type="radio" id="published" name="status" value="published"
                                        {{ old('status') == 'published' ? 'checked' : '' }}>
                                    <label for="published">Publikasi</label>
                                </div>
                            </div>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Harga Kelas -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga Kelas</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                            name="price" min="0" placeholder="Rp. 100000" value="{{ old('price', 0) }}">

                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Level -->
                    <div class="mb-3">
                        <label class="form-label">Level Kelas</label>
                        <div class="radio-groups d-flex align-items-center" style="gap: 1rem;">
                            <div>
                                <input type="radio" id="beginner" name="level" value="beginner"
                                    {{ old('level') == 'beginner' ? 'checked' : '' }}>
                                <label for="beginner">Mudah</label>
                            </div>
                            <div>
                                <input type="radio" id="intermediate" name="level" value="intermediate"
                                    {{ old('level') == 'intermediate' ? 'checked' : '' }}>
                                <label for="intermediate">Menengah</label>
                            </div>
                            <div>
                                <input type="radio" id="expert" name="level" value="expert"
                                    {{ old('level') == 'expert' ? 'checked' : '' }}>
                                <label for="expert">Susah</label>
                            </div>
                        </div>
                        @error('level')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Deskripsi Singkat -->
                    <div class="mb-3">
                        <label for="sort_description" class="form-label">Deskripsi Singkat</label>
                        <textarea name="sort_description" id="sort_description"
                            class="form-control @error('sort_description') is-invalid @enderror" rows="4"
                            placeholder="Masukan Deskripsi Singkat">{{ old('sort_description') }}</textarea>
                        @error('sort_description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Deskripsi Panjang -->
                    <div class="mb-3">
                        <label for="my_editor" class="form-label">Deskripsi Panjang</label>
                        <textarea name="long_description" id="my_editor" class="form-control @error('long_description') is-invalid @enderror"
                            rows="4" placeholder="Masukan Deskripsi Panjang">{{ old('long_description') }}</textarea>
                        @error('long_description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Link Asset -->
                    <div class="mb-3">
                        <label for="link_resources" class="form-label">Link Asset</label>
                        <input type="text" class="form-control @error('link_resources') is-invalid @enderror"
                            id="link_resources" name="link_resources" placeholder="Masukan Link Asset"
                            value="{{ old('link_resources') }}">
                        @error('link_resources')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Link Grub -->
                    <div class="mb-3">
                        <label for="link_groups" class="form-label">Link Grub</label>
                        <input type="text" class="form-control @error('link_groups') is-invalid @enderror"
                            id="link_groups" name="link_groups" placeholder="Masukan Link Grub"
                            value="{{ old('link_groups') }}">
                        @error('link_groups')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary">Tambahkan Sekarang</button>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const freeRadio = document.getElementById('free');
            togglePrice(!freeRadio.checked); // Jika "Gratis" tercentang, read-only
        });

        function togglePrice(isPremium) {
            const priceInput = document.getElementById('price');
            if (isPremium) {
                priceInput.readOnly = false; // Premium -> Bisa diketik
            } else {
                priceInput.readOnly = true; // Free -> Read-only
                priceInput.value = 0; // Harga otomatis 0
            }
        }
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script>
        ClassicEditor
            .create(document.querySelector('#my_editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush

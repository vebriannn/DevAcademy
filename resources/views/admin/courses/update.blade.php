@extends('components.layouts.admin.form')

@section('title', 'Edit Kelas')

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
                <h4 class="text-primary fw-bold mb-4">Edit Kelas</h4>
                <form method="POST" action="{{ route('admin.course.edit.update', $course->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Kategori -->
                    <div class="mb-3">
                        <label class="form-label">Pilih Kategori</label>
                        @if ($category->isEmpty())
                            <div class="alert alert-danger">Data kategori tidak tersedia. Harap tambahkan kategori terlebih
                                dahulu.</div>
                        @else
                            <div class="radio-groups d-flex align-items-center flex-wrap">
                                @foreach ($category as $cat)
                                    <div>
                                        <input type="radio" id="category-{{ $cat->id }}" name="category"
                                            value="{{ $cat->name }}"
                                            {{ $course->category == $cat->name ? 'checked' : '' }}>
                                        <label for="category-{{ $cat->id }}"
                                            class="m-0 p-0 mr-sm-3">{{ $cat->name }}</label>
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
                            name="name" placeholder="Masukan Nama Kelas" value="{{ old('name', $course->name) }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Cover -->
                    <div class="mb-3">
                        <label for="imageUpload" class="form-label">Upload Cover Kelas</label>
                        <input type="file" class="form-control @error('cover') is-invalid @enderror" id="imageUpload"
                            accept="image/*" name="cover">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah cover.</small>
                        @error('cover')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Tools -->
                    <div class="mb-3">
                        <label class="form-label">Pilih Tools</label>
                        @if ($tools->isEmpty())
                            <div class="alert alert-danger">Data tools tidak tersedia. Harap tambahkan tools terlebih
                                dahulu.</div>
                        @else
                            <div class="checkbox-groups d-flex align-items-center flex-wrap">
                                @foreach ($tools as $tool)
                                    <div>
                                        <input type="checkbox" id="tool-{{ $tool->id }}" name="tools[]"
                                            value="{{ $tool->id }}"
                                            {{ in_array($tool->id, $coursetool->tools->pluck('id')->toArray()) ? 'checked' : '' }}>
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
                                        {{ $course->type == 'free' ? 'checked' : '' }} onclick="togglePrice(false)">
                                    <label for="free">Gratis</label>
                                </div>
                                <div>
                                    <input type="radio" id="premium" name="type" value="premium"
                                        {{ $course->type == 'premium' ? 'checked' : '' }} onclick="togglePrice(true)">
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
                                        {{ $course->status == 'draft' ? 'checked' : '' }}>
                                    <label for="draft">Draf</label>
                                </div>
                                <div>
                                    <input type="radio" id="published" name="status" value="published"
                                        {{ $course->status == 'published' ? 'checked' : '' }}>
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
                            name="price" min="0" placeholder="Rp. 100000"
                            value="{{ old('price', $course->price) }}">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Level -->
                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select class="form-select @error('level') is-invalid @enderror" id="level" name="level">
                            <option value="beginner" {{ $course->level == 'beginner' ? 'selected' : '' }}>Pemula</option>
                            <option value="intermediate" {{ $course->level == 'intermediate' ? 'selected' : '' }}>Menengah
                            </option>
                            <option value="advanced" {{ $course->level == 'advanced' ? 'selected' : '' }}>Lanjutan
                            </option>
                        </select>
                        @error('level')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Deskripsi Singkat -->
                    <div class="mb-3">
                        <label for="sort_description" class="form-label">Deskripsi Singkat</label>
                        <textarea name="sort_description" id="sort_description"
                            class="form-control @error('sort_description') is-invalid @enderror" rows="4"
                            placeholder="Masukan Deskripsi Singkat">{{ old('sort_description', $course->sort_description) }}</textarea>
                        @error('sort_description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Deskripsi Panjang -->
                    <div class="mb-3">
                        <label for="long_description" class="form-label">Deskripsi Panjang</label>
                        <textarea name="long_description" id="my_editor"
                            class="form-control @error('long_description') is-invalid @enderror" rows="8"
                            placeholder="Masukan Deskripsi Panjang">{{ old('long_description', $course->long_description) }}</textarea>
                        @error('long_description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Link Asset -->
                    <div class="mb-3">
                        <label for="link_resources" class="form-label">Link Asset</label>
                        <input type="url" class="form-control @error('link_resources') is-invalid @enderror"
                            id="link_resources" name="link_resources" placeholder="Masukan Link Asset (opsional)"
                            value="{{ old('link_resources', $course->link_resources) }}">
                        @error('link_resources')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Link Group -->
                    <div class="mb-3">
                        <label for="link_groups" class="form-label">Link Group</label>
                        <input type="url" class="form-control @error('link_groups') is-invalid @enderror"
                            id="link_groups" name="link_groups" placeholder="Masukan Link Group (opsional)"
                            value="{{ old('link_groups', $course->link_groups) }}">
                        @error('link_groups')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary">Perbarui Kelas</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const freeRadio = document.getElementById('free');
            togglePrice(!freeRadio.checked);
        });

        function togglePrice(isPremium) {
            const priceInput = document.getElementById('price');
            priceInput.readOnly = !isPremium;
            if (!isPremium) priceInput.value = 0;
        }
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#my_editor')).catch(error => console.error(error));
    </script>
@endpush

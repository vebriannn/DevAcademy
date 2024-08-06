@extends('components.layouts.member.edittambah')

@section('title, Edit')

@section('back', 'back')

@section('content-editdatacourses')
<div class="container tambah my-3 p-5 w-75">
    <h2 class="fw-semibold mb-4" style="color: #faa907">Edit Data</h2>
    <div class="row">
        <div class="col-4 h-100">
            <div class="custom-entryarea">
              <input type="file" id="imageUpload" name="imageUpload" accept="image/*" class="custom-file-input" required onchange="previewImage(event)" />
              <label for="imageUpload" class="custom-file-label id="image" name="cover" accept="image/*"">Choose File</label>
              <div class="image-preview" id="preview" src="{{ $courses->cover }}" alt="Image"></div>
            </div>
          </div>
      <form class="col-8" action="" method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-6">
            <div class="custom-entryarea">
              <select id="kategori" name="kategori" required>
                <option value="" disabled selected>Pilih Kategori</option>
                @foreach ($category as $item)
                <option value="{{ $item->name }}"
                    {{ $courses->category == $item->name ? 'selected' : '' }}>
                    {{ $item->name }}
                </option>
            @endforeach
                <!-- Tambahkan lebih banyak opsi sesuai kebutuhan Anda -->
              </select>
            </div>
          </div>
          
          
          <div class="col-6">
            <div class="entryarea">
              <input type="text" id="name" name="name" placeholder="" required
                value="{{ $courses->name }} />
              <div class="labelline" for="name">Tittle</div>
            </div>
          </div>
          <div class="col-12">
            <div class="entryarea">
              <textarea id="desc" name="desc" placeholder="" required style="height: 173px"></textarea>
              <div class="labelline-textarea" for="desc">Description</div>
            </div>
          </div>
          <div class="col-6">
            <div class="entryarea">
              <input type="text" id="name" name="name" placeholder="" required />
              <div class="labelline" for="name">Mentor</div>
            </div>
          </div>

          <div class="col-6">
            <div class="entryarea">
              <input type="text" id="link" name="link" placeholder="" required />
              <div class="labelline" for="link">Link</div>
            </div>
          </div>
          <div class="col-6">
            <div class="entryarea">
              <input type="text" id="price" name="link" placeholder="" required
              value="{{ $courses->price }}" />
              <div class="labelline" for="price">Price</div>
            </div>
          </div>
          <div class="col-6">
            <div class="custom-entryarea">
                <select id="category" name="status" required>
                  <option value="draft" {{ $courses->status == 'draft' ? 'selected' : '' }}>draft
                  </option>
                  <option value="published" {{ $courses->status == 'published' ? 'selected' : '' }}>
                      published</option>
              </select>
            </div>
          </div>
          <div class="col-12">
            <div class="entryarea">
                <select id="category" name="type" required>
                    <option value="free" {{ $courses->type == 'free' ? 'selected' : '' }}>Free</option>
                    <option value="premium" {{ $courses->type == 'premium' ? 'selected' : '' }}>Premium
                    </option>
                </select>
            </div>
    </div>

          <div class="col-6">
            <a href="" class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white fw-semibold btn-kirim" style="background-color: #faa907">Kirim</a>
          </div>
          <div class="col-6">
            <a href="" class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white btn-batal" style="background-color: gray">Reset</a>
          </div>
        </div>
      </form>
    </div>
</div>

<script>
    function previewImage(event) {
  const preview = document.getElementById('imagePreview');
  const file = event.target.files[0];
  
  if (file) {
    const reader = new FileReader();
    reader.onload = function(e) {
      preview.innerHTML = `<img src="${e.target.result}" alt="Image Preview" />`;
    }
    reader.readAsDataURL(file);
  } else {
    preview.innerHTML = ''; // Clear preview if no file is selected
  }
}

</script>
@endsection

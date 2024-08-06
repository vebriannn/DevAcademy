@extends('components.layouts.member.edittambah')

@section('title, Tambah')

@section('back', 'back')

@section('content-tambahlesson')
<div class="container tambah my-3 p-5 w-100">
    <h2 class="fw-semibold mb-4" style="color: #faa907">Tambah Data</h2>
    <div class="row">
      <form class="col-12" action="{{ route('admin.lesson.create.store', $id) }}" method="post"
      enctype="multipart/form-data">
        <div class="row">
          
          @csrf
          <div class="col-12">
            <div class="entryarea">
              <input type="text" id="name" name="name" placeholder="" required />
              <div class="labelline" for="name">Tittle</div>
            </div>
          </div>

          <div class="col-12">
            <div class="entryarea">
              <input type="text" id="link" name="link" placeholder="" required />
              <div class="labelline" for="link">Link</div>
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

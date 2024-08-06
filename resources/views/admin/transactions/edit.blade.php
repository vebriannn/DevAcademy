@extends('components.layouts.member.edittambah')

@section('title, Edit')

@section('back', 'back')

@section('content-edittransactions')
<div class="container my-3 p-5 w-75">
    <div class="row">
      <form class="col-12" action="" method="post" enctype="multipart/form-data">
        <div class="row">
          <h2 class="fw-semibold mb-4" style="color: #faa907">Tambah Data</h2>
          <div class="col-12">
            <div class="entryarea">
              <input type="text" id="name" name="name" placeholder="" required />
              <div class="labelline" for="name">Username</div>
            </div>
          </div>
          <div class="col-12">
            <div class="entryarea">
              <input type="text" id="course" name="course" placeholder="" required />
              <div class="labelline" for="course">Course</div>
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
@endsection
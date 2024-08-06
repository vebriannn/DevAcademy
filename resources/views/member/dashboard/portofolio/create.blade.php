@extends('components.layouts.member.edittambah')

@section('title, Edit')

@section('back', 'back')

@section('content-tambahportofolio')
<div class="container tambah my-3 p-5 w-75">
    <div class="row">
      <form class="col-12" action="" method="post" enctype="multipart/form-data">
        <div class="row">
          <h2 class="fw-semibold mb-4" style="color: #faa907">Tambah Data</h2>
          <div class="col-12">
            <div class="entryarea">
              <input type="text" id="name" name="name" placeholder="" required />
              <div class="labelline" for="name">Name</div>
            </div>
          </div>
          <div class="col-12">
            <div class="entryarea">
              <textarea id="desc" name="desc" placeholder="" required style="height: 173px"></textarea>
              <div class="labelline-textarea" for="desc">Description</div>
            </div>
          </div>
          <div class="col-12" style="margin-top: -7px">
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
@endsection
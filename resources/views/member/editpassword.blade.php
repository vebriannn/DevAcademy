@extends('components.layouts.member.navback')

@section('title, nemolab')

@section('back', 'Back')

@section('content-editpassword')
<link rel="stylesheet" href="{{ asset('nemolab/assets/css/editpassword.css') }}">
<div class="container">
    <div class="row">
      <div class="col-12 mt-4 d-flex justify-content-center">
        <div class="box bg-white rounded-4">
          <h4 class="fw-semibold" style="color: #faa907; margin-bottom: 2rem">Edit Password</h4>
          <form action="">
            <div class="input">
              <label for="old-password">Old Password</label><br />
              <input type="text" id="old-password" class="password"/>
            </div>
            <div class="input my-3">
              <label for="new-password">New Password</label><br />
              <input type="text" id="new-password" class="password/>
            </div>
            <div class="input">
              <label for="confirm-new-password">Confirm New Password</label><br />
              <input type="text" id="confirm-new-password" class="password/>
            </div>
            <div class="input mt-4">
              <input type="submit" value="Save Password" class="button py-2 text-white fw-semibold rounded-5" style="font-size: 14px" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

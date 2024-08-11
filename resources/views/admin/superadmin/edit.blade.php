@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create.css') }}">
@endpush

@section('title', 'Update Super Admin')

@section('content')

<div class="container my-3 p-5 w-75">
    <div class="row">
        <form class="col-12" action="{{ route('admin.superadmin.update', $superadmin->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <h2 class="fw-semibold mb-4" style="color: #faa907">Update Super Admin</h2>
                <div class="col-12 mb-3">
                    <div class="entryarea">
                        <input type="text" id="name" name="name" value="{{ old('name', $superadmin->name) }}" placeholder="" required />
                        <div class="labelline" for="name">Username</div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="entryarea">
                        <input type="text" id="email" name="email" value="{{ old('email', $superadmin->email) }}" placeholder="" required />
                        <div class="labelline" for="email">Email</div>
                    </div>
                </div>
                <div class="col-12 mb-3">
                    <div class="entryarea">
                        <input type="password" id="password" name="password" placeholder="" />
                        <div class="labelline" for="password">Password (leave blank if not changing)</div>
                    </div>
                </div>
                <div class="row col-12 mt-3">
                    <div class="col-6">
                        <button type="submit" class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white fw-semibold btn-kirim" style="background-color: #faa907">Update</button>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('admin.superadmin') }}" class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white btn-batal" style="background-color: gray">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

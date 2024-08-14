@extends('components.layouts.admin.create-update')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('nemolab/admin/css/create-update.css') }}">
@endpush

@section('title', 'Create Mentor')

@section('content')

    <div class="container my-3 p-5 w-75">
        <div class="row">
            <form class="col-12" action="{{ route('admin.mentor.store') }}" method="post">
                @csrf
                <div class="row">
                    <h2 class="fw-semibold mb-4" style="color: #faa907">Tambah Data Mentor</h2>

                    <div class="row col-12 mb-3">
                        <div class="entryarea">
                            <input type="text" id="name" name="name" placeholder="Username" required />
                            <div class="labelline" for="name">Username</div>
                        </div>
                    </div>

                    <div class="row col-12 mb-3">
                        <div class="entryarea">
                            <input type="email" id="email" name="email" placeholder="Email" required />
                            <div class="labelline" for="email">Email</div>
                        </div>
                    </div>

                    <div class="row col-12 mb-3">
                        <div class="entryarea col-6">
                            <input type="password" id="password" name="password" placeholder="Password" required />
                            <div class="labelline" for="password">Password</div>
                        </div>
                        <div class="entryarea col-6">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Confirm Password" required />
                            <div class="labelline" for="password_confirmation">Confirm Password</div>
                        </div>
                    </div>

                    <div class="row col-12 mb-3">
                        <div class="col-6">
                            <button type="submit"
                                class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white fw-semibold btn-kirim"
                                style="background-color: #faa907">Kirim</button>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.mentor') }}"
                                class="d-block w-100 text-center text-decoration-none py-2 rounded-3 text-white btn-batal"
                                style="background-color: gray">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

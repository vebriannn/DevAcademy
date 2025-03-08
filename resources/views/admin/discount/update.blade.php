@extends('components.layouts.admin.form')


@section('title', 'Edit Diskon Kelas')

@section('content')
    <div id="content" class="d-flex align-items-center justify-content-center" style="height: 100vh; padding: 30px 0;">
        <div class="col-12 col-sm-6" style="margin-top: 3rem;">
            <div class="card p-4 shadow">
                <h4 class="text-primary fw-bold">Edit Diskon</h4>
                <form method="POST" action="{{ route('admin.discount.edit.update', $discount->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    {{-- Nama Diskon --}}
                    <div class="mb-3">
                        <label for="code_discount" class="form-label">Nama Diskon</label>
                        <input type="text" class="form-control @error('code_discount') is-invalid @enderror"
                            name="code_discount" placeholder="DevAcademyNew"
                            value="{{ old('code_discount', $discount->code_discount) }}">

                        @error('code_discount')
                            <span class="text-danger" style="font-size: 0.875rem;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Persentase Diskon --}}
                    <div class="mb-3">
                        <label for="rate_discount" class="form-label">Persentase Diskon</label>
                        <input type="number" min="0" max="100"
                            class="form-control @error('rate_discount') is-invalid @enderror" name="rate_discount"
                            placeholder="70" value="{{ old('rate_discount', $discount->rate_discount) }}">

                        @error('rate_discount')
                            <span class="text-danger" style="font-size: 0.875rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Perbarui Diskon</button>
                </form>
            </div>
        </div>
    </div>
@endsection

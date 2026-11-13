@extends('layouts.app')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Tambah Anggota</h5>
    </div>

    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('anggota.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nomor Anggota</label>
                <input type="text" name="nomor_anggota"
                       class="form-control"
                       value="{{ old('nomor_anggota') }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Anggota</label>
                <input type="text" name="nama"
                       class="form-control"
                       value="{{ old('nama') }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor Telepon</label>
                <input type="text" name="telepon"
                       class="form-control"
                       value="{{ old('telepon') }}"
                       required>
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan
            </button>

            <a href="{{ route('anggota.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>

@endsection
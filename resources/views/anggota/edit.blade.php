@extends('layouts.app')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-warning">
        <h5 class="mb-0">Edit Data Anggota</h5>
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

        <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nomor Anggota</label>
                <input type="text" name="nomor_anggota"
                       class="form-control"
                       value="{{ old('nomor_anggota', $anggota->nomor_anggota) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Anggota</label>
                <input type="text" name="nama"
                       class="form-control"
                       value="{{ old('nama', $anggota->nama) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" required>{{ old('alamat', $anggota->alamat) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor Telepon</label>
                <input type="text" name="telepon"
                       class="form-control"
                       value="{{ old('telepon', $anggota->telepon) }}"
                       required>
            </div>

            <button type="submit" class="btn btn-warning">
                Update
            </button>

            <a href="{{ route('anggota.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>

@endsection
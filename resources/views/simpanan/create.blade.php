@extends('layouts.app')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Tambah Simpanan</h5>
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

        <form action="{{ route('simpanan.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Anggota</label>
                <select name="anggota_id" class="form-select" required>
                    <option value="">-- Pilih Anggota --</option>

                    @foreach($anggotas as $anggota)
                        <option value="{{ $anggota->id }}"
                            {{ old('anggota_id') == $anggota->id ? 'selected' : '' }}>
                            {{ $anggota->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Simpanan</label>
                <input type="date" name="tanggal"
                       class="form-control"
                       value="{{ old('tanggal') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Simpanan</label>
                <select name="jenis_simpanan" class="form-select" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="Pokok">Pokok</option>
                    <option value="Wajib">Wajib</option>
                    <option value="Sukarela">Sukarela</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah Simpanan (Rp)</label>
                <input type="number" name="jumlah"
                       class="form-control"
                       min="0" step="0.01"
                       value="{{ old('jumlah') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control">{{ old('keterangan') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Simpan
            </button>

            <a href="{{ route('simpanan.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>

@endsection
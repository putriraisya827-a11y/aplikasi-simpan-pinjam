@extends('layouts.app')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-warning">
        <h5 class="mb-0">Edit Data Simpanan</h5>
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

        <form action="{{ route('simpanan.update', $simpanan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Anggota</label>
                <select name="anggota_id" class="form-select" required>
                    @foreach($anggotas as $anggota)
                        <option value="{{ $anggota->id }}"
                            {{ old('anggota_id', $simpanan->anggota_id) == $anggota->id ? 'selected' : '' }}>
                            {{ $anggota->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Simpanan</label>
                <input type="date" name="tanggal"
                       class="form-control"
                       value="{{ old('tanggal', $simpanan->tanggal) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Simpanan</label>
                <select name="jenis_simpanan" class="form-select" required>
                    <option value="Pokok" {{ old('jenis_simpanan', $simpanan->jenis_simpanan) == 'Pokok' ? 'selected' : '' }}>Pokok</option>
                    <option value="Wajib" {{ old('jenis_simpanan', $simpanan->jenis_simpanan) == 'Wajib' ? 'selected' : '' }}>Wajib</option>
                    <option value="Sukarela" {{ old('jenis_simpanan', $simpanan->jenis_simpanan) == 'Sukarela' ? 'selected' : '' }}>Sukarela</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah Simpanan (Rp)</label>
                <input type="number" name="jumlah"
                       class="form-control"
                       min="0" step="0.01"
                       value="{{ old('jumlah', $simpanan->jumlah) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control">{{ old('keterangan', $simpanan->keterangan) }}</textarea>
            </div>

            <button type="submit" class="btn btn-warning">
                Update
            </button>

            <a href="{{ route('simpanan.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>

@endsection
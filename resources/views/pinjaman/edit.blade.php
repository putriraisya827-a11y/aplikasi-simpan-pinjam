@extends('layouts.app')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-warning">
        <h5 class="mb-0">Edit Data Pinjaman</h5>
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

        <form action="{{ route('pinjaman.update', $pinjaman->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Anggota</label>
                <select name="anggota_id" class="form-select" required>
                    @foreach($anggotas as $anggota)
                        <option value="{{ $anggota->id }}"
                            {{ old('anggota_id', $pinjaman->anggota_id) == $anggota->id ? 'selected' : '' }}>
                            {{ $anggota->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam"
                       class="form-control"
                       value="{{ old('tanggal_pinjam', $pinjaman->tanggal_pinjam) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah Pinjaman (Rp)</label>
                <input type="number" name="jumlah_pinjaman"
                       class="form-control"
                       min="0" step="0.01"
                       value="{{ old('jumlah_pinjaman', $pinjaman->jumlah_pinjaman) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Bunga (%)</label>
                <input type="number" name="bunga"
                       class="form-control"
                       min="0" step="0.01"
                       value="{{ old('bunga', $pinjaman->bunga) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tenor (Bulan)</label>
                <input type="number" name="tenor"
                       class="form-control"
                       min="1"
                       value="{{ old('tenor', $pinjaman->tenor) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select" required>
                    <option value="diajukan" {{ old('status', $pinjaman->status) == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                    <option value="disetujui" {{ old('status', $pinjaman->status) == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="ditolak" {{ old('status', $pinjaman->status) == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    <option value="lunas" {{ old('status', $pinjaman->status) == 'lunas' ? 'selected' : '' }}>Lunas</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control">{{ old('keterangan', $pinjaman->keterangan) }}</textarea>
            </div>

            <button type="submit" class="btn btn-warning">
                Update
            </button>

            <a href="{{ route('pinjaman.index') }}" class="btn btn-secondary">
                Kembali
            </a>
        </form>

    </div>
</div>

@endsection
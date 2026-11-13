@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Data Simpanan</h3>

    <div>
        <a href="{{ route('laporan.simpanan') }}" target="_blank" class="btn btn-danger">
            Cetak PDF
        </a>

        <a href="{{ route('simpanan.create') }}" class="btn btn-primary">
            + Tambah Simpanan
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>No</th>
                    <th>Nama Anggota</th>
                    <th>Tanggal</th>
                    <th>Jenis Simpanan</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($simpanans as $simpanan)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $simpanan->anggota->nama ?? '-' }}</td>
                        <td>{{ $simpanan->tanggal }}</td>
                        <td>{{ $simpanan->jenis_simpanan }}</td>
                        <td>Rp {{ number_format($simpanan->jumlah, 0, ',', '.') }}</td>
                        <td>{{ $simpanan->keterangan ?? '-' }}</td>
                        <td>
                            <a href="{{ route('simpanan.show', $simpanan->id) }}"
                               class="btn btn-info btn-sm">
                                Detail
                            </a>

                            <a href="{{ route('simpanan.edit', $simpanan->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('simpanan.destroy', $simpanan->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            Belum ada data simpanan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection
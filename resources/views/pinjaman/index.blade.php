@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Data Pinjaman</h3>

    <div>
        <a href="{{ route('laporan.pinjaman') }}" target="_blank" class="btn btn-danger">
            Cetak PDF
        </a>

        <a href="{{ route('pinjaman.create') }}" class="btn btn-primary">
            + Tambah Pinjaman
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
                    <th>Tanggal Pinjam</th>
                    <th>Jumlah Pinjaman</th>
                    <th>Bunga (%)</th>
                    <th>Tenor</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pinjamans as $pinjaman)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pinjaman->anggota->nama ?? '-' }}</td>
                        <td>{{ $pinjaman->tanggal_pinjam }}</td>
                        <td>Rp {{ number_format($pinjaman->jumlah_pinjaman, 0, ',', '.') }}</td>
                        <td>{{ $pinjaman->bunga }}%</td>
                        <td>{{ $pinjaman->tenor }} bulan</td>
                        <td>{{ ucfirst($pinjaman->status) }}</td>
                        <td>
                            <a href="{{ route('pinjaman.show', $pinjaman->id) }}"
                               class="btn btn-info btn-sm">
                                Detail
                            </a>

                            <a href="{{ route('pinjaman.edit', $pinjaman->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('pinjaman.destroy', $pinjaman->id) }}"
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
                        <td colspan="8" class="text-center">
                            Belum ada data pinjaman.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection
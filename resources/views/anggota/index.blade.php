@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h3>Data Anggota</h3>

    <div>
        <a href="{{ route('laporan.anggota') }}" target="_blank" class="btn btn-danger">
            Cetak PDF
        </a>

        <a href="{{ route('anggota.create') }}" class="btn btn-primary">
            + Tambah Anggota
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
                    <th>Nomor Anggota</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($anggotas as $anggota)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $anggota->nomor_anggota }}</td>
                        <td>{{ $anggota->nama }}</td>
                        <td>{{ $anggota->alamat }}</td>
                        <td>{{ $anggota->telepon }}</td>
                        <td>
                            <a href="{{ route('anggota.edit', $anggota->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('anggota.destroy', $anggota->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus anggota ini?')">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            Belum ada data anggota.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection
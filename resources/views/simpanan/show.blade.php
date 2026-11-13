@extends('layouts.app')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0">Detail Simpanan</h5>
    </div>

    <div class="card-body">

        <table class="table table-bordered">
            <tr>
                <th width="30%">Nama Anggota</th>
                <td>{{ $simpanan->anggota->nama ?? '-' }}</td>
            </tr>

            <tr>
                <th>Tanggal Simpanan</th>
                <td>{{ $simpanan->tanggal }}</td>
            </tr>

            <tr>
                <th>Jenis Simpanan</th>
                <td>{{ $simpanan->jenis_simpanan }}</td>
            </tr>

            <tr>
                <th>Jumlah Simpanan</th>
                <td>Rp {{ number_format($simpanan->jumlah, 0, ',', '.') }}</td>
            </tr>

            <tr>
                <th>Keterangan</th>
                <td>{{ $simpanan->keterangan ?? '-' }}</td>
            </tr>
        </table>

        <a href="{{ route('simpanan.index') }}" class="btn btn-secondary">
            Kembali
        </a>

        <a href="{{ route('simpanan.edit', $simpanan->id) }}" class="btn btn-warning">
            Edit
        </a>

    </div>
</div>

@endsection
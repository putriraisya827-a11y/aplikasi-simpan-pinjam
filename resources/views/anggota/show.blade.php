@extends('layouts.app')

@section('content')

<div class="card shadow-sm">
    <div class="card-header bg-info text-white">
        <h5 class="mb-0">Detail Anggota</h5>
    </div>

    <div class="card-body">

        <table class="table table-bordered">
            <tr>
                <th width="30%">Nomor Anggota</th>
                <td>{{ $anggota->nomor_anggota }}</td>
            </tr>

            <tr>
                <th>Nama Anggota</th>
                <td>{{ $anggota->nama }}</td>
            </tr>

            <tr>
                <th>Alamat</th>
                <td>{{ $anggota->alamat }}</td>
            </tr>

            <tr>
                <th>Nomor Telepon</th>
                <td>{{ $anggota->telepon }}</td>
            </tr>
        </table>

        <a href="{{ route('anggota.index') }}" class="btn btn-secondary">
            Kembali
        </a>

        <a href="{{ route('anggota.edit', $anggota->id) }}" class="btn btn-warning">
            Edit
        </a>

    </div>
</div>

@endsection
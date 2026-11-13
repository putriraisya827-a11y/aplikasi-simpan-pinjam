<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use App\Models\Anggota;
use Illuminate\Http\Request;

class PinjamanController extends Controller
{
    public function index()
    {
        $pinjamans = Pinjaman::with('anggota')->latest()->get();
        return view('pinjaman.index', compact('pinjamans'));
    }

    public function create()
    {
        $anggotas = Anggota::all();
        return view('pinjaman.create', compact('anggotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'tanggal_pinjam' => 'required|date',
            'jumlah_pinjaman' => 'required|numeric|min:0',
            'bunga' => 'required|numeric|min:0',
            'tenor' => 'required|integer|min:1',
            'status' => 'required',
            'keterangan' => 'nullable',
        ]);

        Pinjaman::create($request->all());

        return redirect()->route('pinjaman.index')
            ->with('success', 'Pinjaman berhasil ditambahkan.');
    }

    public function show(Pinjaman $pinjaman)
    {
        $anggotas = Anggota::all();
        return view('pinjaman.show', compact('pinjaman','anggotas'));
    }

    public function edit(Pinjaman $pinjaman)
    {
        $anggotas = Anggota::all();
        return view('pinjaman.edit', compact('pinjaman', 'anggotas'));
    }

    public function update(Request $request, Pinjaman $pinjaman)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'tanggal_pinjam' => 'required|date',
            'jumlah_pinjaman' => 'required|numeric|min:0',
            'bunga' => 'required|numeric|min:0',
            'tenor' => 'required|integer|min:1',
            'status' => 'required',
            'keterangan' => 'nullable',
        ]);

        $pinjaman->update($request->all());

        return redirect()->route('pinjaman.index')
            ->with('success', 'Pinjaman berhasil diubah.');
    }

    public function destroy(Pinjaman $pinjaman)
    {
        $pinjaman->destroy($pinjaman->id);

        return redirect()->route('pinjaman.index')
            ->with('success', 'Pinjaman berhasil dihapus.');
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = Anggota::query()->
        where('user_id',Auth::id())->latest()->get();

        return view('anggota.index', compact('anggotas'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_anggota' => 'required|unique:anggotas,nomor_anggota',
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        Anggota::create([
            'user_id' => Auth::id(),
            'nomor_anggota' => $request->nomor_anggota,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function show(Anggota $anggota)
    {
        abort_if($anggota->user_id !== Auth::id(), 403);

        return view('anggota.show', compact('anggota'));
    }

    public function edit($sid)
    {
        $anggota = Anggota::findOrFail($sid);

        abort_if((int) $anggota->user_id !== (int) Auth::id(), 403);
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        abort_if($anggota->user_id !== Auth::id(), 403);

        $request->validate([
            'nomor_anggota' => 'required|unique:anggotas,nomor_anggota,' . $anggota->id,
            'nama' => 'required',
            'alamat' => 'required',
            'telepon' => 'required',
        ]);

        $anggota->update($request->only([
            'nomor_anggota',
            'nama',
            'alamat',
            'telepon',
        ]));

        return redirect()->route('anggota.index')
            ->with('success', 'Data anggota berhasil diubah.');
    }

    public function destroy(Anggota $anggota)
    {
        abort_if($anggota->user_id !== Auth::id(), 403);

        $anggota->destroy($anggota->id);

        return redirect()->route('anggota.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
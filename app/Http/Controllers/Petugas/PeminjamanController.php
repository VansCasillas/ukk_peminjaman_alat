<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\PeminjamanAlat;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjamanalat = PeminjamanAlat::with(['alat.kategori'])->get();
        return view('petugas.peminjaman.index', compact('peminjamanalat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $peminjamanalat = PeminjamanAlat::with(['alat.kategori', 'detailAlat'])->findOrFail($id);
        return view('petugas.peminjaman.edit', compact('peminjamanalat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'persetujuan' => 'required|in:disetujui,ditolak',
        ]);

        $peminjamanalat = PeminjamanAlat::findOrFail($id);
        $peminjamanalat->detailAlat->persetujuan = $request->persetujuan;
        $peminjamanalat->detailAlat->save();

        if ($request->persetujuan == 'disetujui') {
            $peminjamanalat->detailAlat->status = 'dipinjam';
        } else {
            $peminjamanalat->detailAlat->status = 'dikembalikan';
        }
        $peminjamanalat->detailAlat->save();

        return redirect()->route('petugas.peminjaman.index')->with('success', 'Status persetujuan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

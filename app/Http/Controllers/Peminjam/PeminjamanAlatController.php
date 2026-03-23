<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\DetailPeminjaman;
use App\Models\PeminjamanAlat;
use Illuminate\Http\Request;

class PeminjamanAlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $terlambat = PeminjamanAlat::with('alat', 'detailAlat')
            ->where('tanggal_kembali', '<', now())
            
            ->get();
        $peminjamanalat = PeminjamanAlat::with(['alat.kategori', 'detailAlat'])->where('user_id', auth()->id())->get();
        return view('peminjam.peminjaman.index', compact('peminjamanalat', 'terlambat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $peminjam = auth()->user();
        $alat = Alat::with('kategori')->findOrFail($id);
        return view('peminjam.peminjaman.create', compact('peminjam', 'alat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'qty' => 'required|integer|min:1',
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        // 🚨 CEK STOK
        if ($alat->qty < $request->qty) {
            return back()->with('error', 'Stok tidak cukup!');
        }

        $peminjaman = PeminjamanAlat::create([
            'user_id' => auth()->id(),
            'alat_id' => $request->alat_id,
            'tanggal_pinjam' => now(),
            'tanggal_kembali' => $request->tanggal_kembali,
        ]);

        // ⬇️ KURANGI STOK
        $alat->decrement('qty', $request->qty);

        DetailPeminjaman::create([
            'user_id' => auth()->id(),
            'peminjaman_alat_id' => $peminjaman->id,
            'qty' => $request->qty,
        ]);

        return redirect()->route('peminjam.peminjaman.index')->with('success', 'Peminjaman berhasil dibuat.');
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
        $peminjaman = PeminjamanAlat::with(['alat.kategori', 'detailAlat'])->findOrFail($id);
        return view('peminjam.peminjaman.edit', compact('peminjaman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'qty' => 'required|integer|min:1',
            'tanggal_kembali' => 'required|date',
        ]);

        $peminjaman = PeminjamanAlat::with('detailAlat')->findOrFail($id);
        $detail = $peminjaman->detailAlat;
        $alat = Alat::findOrFail($peminjaman->alat_id);

        $qty_lama = $detail->qty;
        $qty_baru = $request->qty;

        // 🔁 HITUNG SELISIH
        $selisih = $qty_baru - $qty_lama;

        // CEK kalau nambah
        if ($selisih > 0 && $alat->qty < $selisih) {
            return back()->with('error', 'Stok tidak cukup untuk penambahan!');
        }

        // UPDATE STOK
        if ($selisih > 0) {
            $alat->decrement('qty', $selisih);
        } elseif ($selisih < 0) {
            $alat->increment('qty', abs($selisih));
        }

        // UPDATE DATA
        $detail->update([
            'qty' => $qty_baru,
        ]);

        $peminjaman->update([
            'tanggal_kembali' => $request->tanggal_kembali,
        ]);

        return redirect()->route('peminjam.peminjaman.index')->with('success', 'Peminjaman berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peminjaman = PeminjamanAlat::with('detailAlat')->findOrFail($id);
        $detail = $peminjaman->detailAlat;
        $alat = Alat::findOrFail($peminjaman->alat_id);

        // ⬆️ BALIKIN STOK
        $alat->increment('qty', $detail->qty);

        // HAPUS DETAIL DULU
        $detail->delete();

        // HAPUS PEMINJAMAN
        $peminjaman->delete();

        return redirect()->route('peminjam.peminjaman.index')->with('success', 'Peminjaman berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alat = Alat::with('kategori')->get();
        return view('admin.alat.index', compact('alat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori = Kategori::all();
        return view('admin.alat.create', compact('kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'qty' => 'required|integer',
        ]);

        Alat::create($request->all());
        return redirect()->route('admin.alat.index')->with('success', 'Alat berhasil ditambahkan.');
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
        $alat = Alat::findOrfail($id);
        $kategori = Kategori::all();
        return view('admin.alat.edit', compact('alat', 'kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'qty' => 'required|integer',
        ]);

        $alat = Alat::findOrFail($id);
        $alat->update($request->all());
        return redirect()->route('admin.alat.index')->with('success', 'Alat berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::find($id);
        if ($kategori) {
            $kategori->delete();
            return redirect()->route('admin.kategori.index')->with('success', 'Data kategori berhasil dihapus.');
        }
        return redirect()->route('admin.kategori.index')->with('error', 'Data kategori tidak ditemukan.');
    }
}

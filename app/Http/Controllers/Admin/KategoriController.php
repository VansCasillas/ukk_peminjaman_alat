<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|unique:kategoris,nama_kategori,' . $kategori->id,
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
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
    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategori.edit', compact('kategori'));
    }
    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|unique:kategoris,nama_kategori,' . $kategori->id,
        ]);

        $data = [
            'nama_kategori' => $request->nama_kategori,
        ];

        $kategori->update($data);

        return redirect()->route('admin.kategori.index')->with('status', 'Data Kategori berhasil diperbarui.');
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

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PeminjamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'peminjam')->get();
        return view('admin.peminjam.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.peminjam.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => '',
        ]);

        //Simpan peminjam baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'peminjam',
        ]);

        return redirect()->route('admin.peminjam.index')
            ->with('status', 'Data User berhasil ditambahkan.');
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
    public function edit(User $peminjam)
    {
        return view('admin.peminjam.edit', compact('peminjam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $peminjam)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email,' . $peminjam->id,
            'password' => 'nullable|string|min:6',
        ]);

        // Update tabel users
        $dataUser = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $dataUser['password'] = Hash::make($request->password);
        }

        $peminjam->update($dataUser);
        return redirect()->route('admin.peminjam.index')->with('success', 'Data peminjam berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peminjam = User::find($id);
        if ($peminjam) {
            $peminjam->delete();
            return redirect()->route('admin.peminjam.index')->with('success', 'Data peminjam berhasil dihapus.');
        }
        return redirect()->route('admin.peminjam.index')->with('error', 'Data peminjam tidak ditemukan.');
    }
}
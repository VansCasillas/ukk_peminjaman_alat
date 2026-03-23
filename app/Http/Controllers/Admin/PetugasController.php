<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('role', 'petugas')->get();
        return view('admin.petugas.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.petugas.create');
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

        //Simpan petugas baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'petugas',
        ]);

        return redirect()->route('admin.petugas.index')
            ->with('status', 'Data Petugas berhasil ditambahkan.');
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
    public function edit(User $petuga)
    {
        return view('admin.petugas.edit', compact('petuga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $petuga)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email,' . $petuga->id,
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

        $petuga->update($dataUser);
        return redirect()->route('admin.petugas.index')->with('success', 'Data petugas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $petuga = User::find($id);
        if ($petuga) {
            $petuga->delete();
            return redirect()->route('admin.petugas.index')->with('success', 'Data petugas berhasil dihapus.');
        }
        return redirect()->route('admin.petugas.index')->with('error', 'Data petugas tidak ditemukan.');
    }
}
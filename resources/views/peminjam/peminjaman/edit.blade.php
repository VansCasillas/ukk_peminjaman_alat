@extends('layouts.app')

@section('title', 'Create Data User')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Peminjaman</h2>

    <form action="{{ route('peminjam.peminjaman.update', $peminjaman->id) }}" method="POST" class="bg-white p-4 rounded shadow-sm">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold text-dark">Nama Peminjam</label>
            <input type="text" id="name" name="user_id" class="form-control styled-input" value="{{ $peminjaman->user->name }}" readonly>
            @error('user_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold text-dark">Nama Alat</label>
            <input type="text" class="form-control styled-input"
                value="{{ $peminjaman->alat->nama_alat }}" readonly>

            <!-- INI YANG DIKIRIM KE CONTROLLER -->
            <input type="hidden" name="alat_id" value="{{ $peminjaman->alat->id }}">

            @error('alat_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold text-dark">Jenis Kategori</label>
            <input type="text" id="name" name="kategori_id" class="form-control styled-input" value="{{ $peminjaman->alat->kategori->nama_kategori }}" readonly>
            @error('kategori_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold text-dark">Jumlah Alat</label>
            <input type="text" id="name" name="qty" class="form-control styled-input" value="{{ $peminjaman->detailAlat->qty ?? '' }}">
            <span class="form-text text-muted">* Masukkan jumlah alat yang baru</span>
            @error('qty') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold text-dark">Tanggal Kembali</label>
            <input type="date" id="name" name="tanggal_kembali" class="form-control styled-input" value="{{ $peminjaman->tanggal_kembali}}">
            <span class="form-text text-muted">* Masukkan tanggal kembali yang baru</span>
            @error('tanggal_kembali') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-dark px-4">Simpan</button>
            <a href="{{ route('peminjam.peminjaman.index') }}" class="btn btn-outline-secondary px-4 ms-2">Kembali</a>
        </div>
    </form>
</div>

<style>
    /* 🔹 Styling input biar kotaknya jelas */
    .styled-input {
        border: 1.5px solid #bbb;
        border-radius: 8px;
        padding: 10px 12px;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .styled-input:focus {
        border-color: #000;
        box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.1);
        outline: none;
    }

    label {
        margin-bottom: 6px;
    }
</style>
@endsection
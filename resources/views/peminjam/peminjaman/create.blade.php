@extends('layouts.app')

@section('title', 'Create Peminjaman')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Buat Peminjaman</h2>

    <form action="{{ route('peminjam.peminjaman.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label fw-semibold text-dark">Nama Peminjam</label>
            <input type="text" id="name" name="user_id" class="form-control styled-input" value="{{ $peminjam->name }}" readonly>
            @error('user_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold text-dark">Nama Alat</label>
            <input type="text" class="form-control styled-input"
                value="{{ $alat->nama_alat }}" readonly>

            <!-- INI YANG DIKIRIM KE CONTROLLER -->
            <input type="hidden" name="alat_id" value="{{ $alat->id }}">

            @error('alat_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold text-dark">Jenis Kategori</label>
            <input type="text" id="name" name="kategori_id" class="form-control styled-input" value="{{ $alat->kategori->nama_kategori }}" readonly>
            @error('kategori_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold text-dark">Jumlah Alat</label>
            <input type="number" id="name" name="qty" class="form-control styled-input" max="{{ $alat->qty }}" min="1" placeholder="Masukan jumlah alat">
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
            @error('qty') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label fw-semibold text-dark">Tanggal Pengembalian</label>
            <input type="date" id="name" name="tanggal_kembali" class="form-control styled-input" placeholder="tanggal dikembalikan">
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
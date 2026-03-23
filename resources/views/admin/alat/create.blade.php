@extends('layouts.app')

@section('title', 'Create Data Alat')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Tambah Alat</h2>

    <form action="{{ route('admin.alat.store') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label fw-semibold text-dark">Nama Alat</label>
            <input type="text" id="name" name="nama_alat" class="form-control styled-input" value="{{ old('nama_alat') }}">
            @error('nama_alat') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label fw-semibold text-dark">Jenis Kategori</label>
            <select name="kategori_id" id="jenis_kategori" class="form-control styled-input">
                <option value="" disabled selected>Pilih Kategori</option>
                @foreach ($kategori as $ktr)
                    <option value="{{ $ktr->id }}" {{ old('kategori_id') == $ktr->id ? 'selected' : '' }}>{{ $ktr->nama_kategori }}</option>
                @endforeach
            </select>
            @error('kategori_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="qty" class="form-label fw-semibold text-dark">Qty</label>
            <input type="text" id="qty" name="qty" class="form-control styled-input" value="{{ old('qty') }}">
            @error('qty') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-dark px-4">Simpan</button>
            <a href="{{ route('admin.alat.index') }}" class="btn btn-outline-secondary px-4 ms-2">Kembali</a>
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
        box-shadow: 0 0 0 2px rgba(0,0,0,0.1);
        outline: none;
    }

    label {
        margin-bottom: 6px;
    }
</style>
@endsection

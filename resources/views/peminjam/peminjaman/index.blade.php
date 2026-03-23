@extends('layouts.app')

@section('title', 'Peminjaman Alat')

@section('content')

<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Peminjaman Alat</h6>
            </div>
        </div>
        <div class="m-3 mb-2">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            {{-- Notif keterlambatan --}}
            <!-- @foreach($terlambat as $item)
            <div class="alert alert-danger">
                Peminjaman {{ $item->detailAlat->qty }} {{ $item->alat->nama_alat }} sudah lewat tanggal pengembalian
            </div>
            @endforeach -->
        </div>
        <div class="card-body px-3 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" id="siswa">
                    <thead>
                        <tr>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Alat</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">kategori</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">qty</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Pinjam</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal Kembali</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Persetujuan</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peminjamanalat as $pemalt)
                        @if ($pemalt->detailAlat->status != 'dikembalikan')
                        <tr>
                            <td class="text-center align-middle text-sm">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle text-sm">{{ $pemalt->alat->nama_alat }}</td>
                            <td class="text-center align-middle text-left text-sm">{{ $pemalt->alat->kategori->nama_kategori }}</td>
                            <td class="text-center align-middle text-left text-sm">{{ $pemalt->detailAlat->qty}}</td>
                            <td class="text-center align-middle text-left text-sm">{{ $pemalt->tanggal_pinjam }}</td>
                            <td class="text-center align-middle text-left text-sm">{{ $pemalt->tanggal_kembali }}</td>
                            <td class="text-center align-middle text-left text-sm">{{ $pemalt->detailAlat->status ?? 'Belum Diperiksa' }}</td>
                            <td class="text-center align-middle text-left text-sm">{{ $pemalt->detailAlat->persetujuan ?? 'Belum Disetujui' }}</td>
                            <td class="text-center align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    <a style="position: relative; top: 7px;" href="{{ route('peminjam.peminjaman.edit', $pemalt->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('peminjam.peminjaman.destroy', $pemalt->id) }}" method="post" onsubmit="return confirm('Yakin ingin menghapus peminjaman ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button style="position: relative; top: 7px;" type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#siswa').DataTable();
    });
</script>
@endsection
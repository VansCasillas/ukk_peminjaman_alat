@extends('layouts.app')

@section('title', 'Pengembalian Pengguna')

@section('content')
<div class="col-12">
    <div class="card my-4">
        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Pengembalian Masuk</h6>
            </div>
        </div>
        <div class="m-3">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
            @endif
        </div>
        <button class="btn btn-success m-3" onclick="window.print()">Cetak</button>
        <div id="area-print">
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
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($peminjamanalat as $pemalt)
                            @if ($pemalt->detailAlat->status == 'dipinjam' || $pemalt->detailAlat->status == 'dikembalikan')
                            <tr>
                                <td class="text-center align-middle text-sm">{{ $loop->iteration }}</td>
                                <td class="text-center align-middle text-sm">{{ $pemalt->alat->nama_alat }}</td>
                                <td class="text-center align-middle text-left text-sm">{{ $pemalt->alat->kategori->nama_kategori }}</td>
                                <td class="text-center align-middle text-left text-sm">{{ $pemalt->detailAlat->qty ?? 0 }}</td>
                                <td class="text-center align-middle text-left text-sm">{{ $pemalt->tanggal_pinjam }}</td>
                                <td class="text-center align-middle text-left text-sm">{{ $pemalt->tanggal_kembali }}</td>
                                <td class="text-center align-middle text-left text-sm">{{ $pemalt->detailAlat->status ?? 'Belum Diperiksa' }}</td>
                                <td class="text-center align-middle text-left text-sm">{{ $pemalt->detailAlat->persetujuan ?? 'Belum Disetujui' }}</td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    @media print {

        /* SEMBUNYIKAN SEMUA */
        body * {
            visibility: hidden;
        }

        /* TAMPILKAN AREA PRINT SAJA */
        #area-print,
        #area-print * {
            visibility: visible;
        }

        #area-print {
            width: 100%;
        }
    }
</style>
<script>
    $(document).ready(function() {
        $('#siswa').DataTable({
            paging: false,
            searching: false,
            info: false
        });
    });
</script>
@endsection
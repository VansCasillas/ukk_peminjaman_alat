<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PeminjamanAlat extends Model
{
    protected $table = 'peminjaman_alats';

    protected $fillable = [
        'user_id',
        'alat_id',
        'tanggal_pinjam',
        'tanggal_kembali',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }

    public function detailAlat()
    {
        return $this->hasOne(DetailPeminjaman::class, 'peminjaman_alat_id');
    }
}

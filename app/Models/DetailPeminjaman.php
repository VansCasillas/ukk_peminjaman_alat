<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    protected $table = 'detail_peminjamen';

    protected $fillable = [
        'user_id',
        'peminjaman_alat_id',
        'qty',
        'status',
        'persetujuan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function peminjamanAlat()
    {
        return $this->belongsTo(PeminjamanAlat::class);
    }
}

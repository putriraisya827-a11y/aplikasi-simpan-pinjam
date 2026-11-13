<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pinjaman extends Model
{
    protected $table = 'pinjamans';

    protected $fillable = [
        'anggota_id',
        'tanggal_pinjam',
        'jumlah_pinjaman',
        'bunga',
        'tenor',
        'status',
        'keterangan',
    ];

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class);
    }
}
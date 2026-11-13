<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Anggota extends Model
{
    protected $fillable = [
        'user_id',
        'nomor_anggota',
        'nama',
        'alamat',
        'telepon',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function simpanans(): HasMany
    {
        return $this->hasMany(Simpanan::class);
    }

    public function pinjamans(): HasMany
    {
        return $this->hasMany(Pinjaman::class);
    }
}
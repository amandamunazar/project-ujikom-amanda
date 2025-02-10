<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'tm_pengembalian'; // Nama tabel pengembalian di database

    protected $primaryKey = 'kembali_id';

    protected $fillable = [
        'kembali_id',
        'pb_id',
        'kembali_tgl',
        'kembali_sts',
        'user_id',
    ];

    public $timestamps = true;

    // Relasi ke peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'pb_id', 'pb_id');
    }
}

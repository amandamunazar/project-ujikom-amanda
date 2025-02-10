<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanBarang extends Model
{
    use HasFactory;

    protected $table = 'td_peminjaman_barang';
    protected $primaryKey = 'pbd_id';
    protected $incementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'pdb_id', 'pb_id', 'br_kode', 'pdb_tgl', 'pdb_sts'
    ];

    public function peminjaman() {
        return $this->belongsTo(Peminjaman::class, 'pb_id', 'pb_id');
    }

    public function barangInventaris() {
        return $this->belongsTo(BarangInventaris::class, 'br_kode', 'br_kode');
    }

}

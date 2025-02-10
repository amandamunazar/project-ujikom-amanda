<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'tm_peminjaman';
    protected $primaryKey = 'pb_id';
    public $incrementing = false; // Karena pb_id dibuat manual
    protected $keyType = 'string';

    protected $fillable = [
        'pb_id', 'user_id', 'pb_no_siswa', 'pb_nama_siswa', 'pb_tgl', 'pb_harus_kembali_tgl', 'pb_stat'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function peminjaman_barang() {
        return $this->hasMany(PeminjamanBarang::class, 'pb_id', 'pb_id');
    }

    // public static function generatePbId()
    // {
    //     $kode = "PB";
    //     $tahun = date('Y'); // Format YYYY
    //     $bulan = date('m'); // Format MM

    //     // Ambil nomor urut terakhir untuk bulan dan tahun ini
    //     $lastId = DB::table('tm_peminjaman')
    //         ->whereRaw("SUBSTRING(pb_id,3,4) = ?", [$tahun])
    //         ->whereRaw("SUBSTRING(pb_id,7,2) = ?", [$bulan])
    //         ->selectRaw("IFNULL(MAX(SUBSTRING(pb_id,10,3)),0) + 1 as next_number")
    //         ->first();

    //     $nomorUrut = str_pad($lastId->next_number, 3, '0', STR_PAD_LEFT); // Format NNN (001, 002, dst)
        
    //     return "{$kode}{$tahun}{$bulan}{$nomorUrut}";
    // }

    // public static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($peminjaman) {
    //         if (empty($peminjaman->pb_id)) {
    //             $peminjaman->pb_id = self::generatePbId();
    //         }
    //     });
    // }
}

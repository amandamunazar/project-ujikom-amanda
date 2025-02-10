<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BarangInventaris extends Model
{
    use HasFactory;

    protected $table = 'tm_barang_inventaris';
    protected $primaryKey = 'br_kode';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'br_kode',
        'jns_brg_kode',
        'user_id',
        'br_nama',
        'br_tgl_terima',
        'br_tgl_entry',
        'br_status'
    ];

    public static function generateKodeBarang()
    {
        $currentYear = date('Y');
        $prefix = 'INV';

        $maxKode = DB::table('tm_barang_inventaris')
            ->select(DB::raw("IFNULL(MAX(CAST(SUBSTRING(br_kode, 8, 5) AS UNSIGNED)), 0) + 1 AS next_kode"))
            ->whereRaw("SUBSTRING(br_kode, 4,4) = ?", [$currentYear])
            ->value('next_kode');

        return sprintf("%s%s%05d", $prefix, $currentYear, $maxKode);
    }

   public function jenis_barang()
{
    return $this->belongsTo(JenisBarang::class, 'jns_brg_kode', 'jns_brg_kode');
}

public function peminjaman_barang() {
    return $this->hasMany(Peminjaman::class, 'br_kode', 'br_kode');
}

public function users()
{
return $this->hasMany(User::class, 'user_id');
}



}

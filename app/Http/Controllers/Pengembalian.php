<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\PeminjamanBarang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    public function index()
    {
        $pengembalian = Pengembalian::with('peminjaman')->get();
        return view('pengembalian.index', compact('pengembalian'));
    }

    public function create()
    {
        $peminjaman = Peminjaman::where('pb_stat', 1)->get(); // Ambil peminjaman yang masih aktif
        return view('pengembalian.create', compact('peminjaman'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'pb_id' => 'required|string|exists:tm_peminjaman,pb_id',
    ]);

    DB::beginTransaction();
    try {
        $kembali_id = 'KB' . date('YmdHis'); // Generate ID Pengembalian

        Pengembalian::create([
            'kembali_id' => $kembali_id,
            'pb_id' => $validated['pb_id'],
            'kembali_tgl' => now(),
            'kembali_sts' => '1', // Default: Barang dalam kondisi baik
            'user_id' => Auth::id(),
        ]);

        // Ubah status peminjaman menjadi selesai
        Peminjaman::where('pb_id', $validated['pb_id'])->update(['pb_stat' => 2]);

        DB::commit();
        return response()->json(['message' => 'Barang berhasil dikembalikan!']);
    } catch (\Throwable $th) {
        DB::rollBack();
        return response()->json(['error' => 'Terjadi kesalahan saat menyimpan data'], 500);
    }
}
}

<?php

namespace App\Http\Controllers;

use App\Models\BarangInventaris;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\PeminjamanBarang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::all();
        return view('peminjaman.index', compact('peminjaman'));
    }

     public function create()
    {
        $barang = BarangInventaris::where('br_status', '1')->get();  // Ambil data barang dari database
        return view('peminjaman.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pb_no_siswa' => 'required|string|max:20',
            'pb_nama_siswa' => 'required|string|max:100',
            'pb_harus_kembali_tgl' => 'required|date',
            'data_peminjaman' => 'required|array',
            'data_peminjaman.*.br_kode' => 'required|exists:tm_barang_inventaris,br_kode', 
        ]);
        
        DB::beginTransaction();
        try {
            // Generate pb_id (Peminjaman ID)
            $pb_id = 'PJ' . date('Y-m') . str_pad(Peminjaman::count() + 1, 4, '0', STR_PAD_LEFT);
            $pb_tgl = now();
            
            // Simpan data peminjaman ke tabel tm_peminjaman
            $peminjaman = new Peminjaman([
                'pb_id' => $pb_id,
                'user_id' => Auth::user()->user_id,
                'br_kode' => $request->br_kode,  // Jika ada, jika tidak perlu bisa dihapus
                'pb_tgl' => $pb_tgl,
                'pb_no_siswa' => $validated['pb_no_siswa'],
                'pb_nama_siswa' => $validated['pb_nama_siswa'],
                'pb_harus_kembali_tgl' => $validated['pb_harus_kembali_tgl'],
                'pb_stat' => '1',
            ]);
            
            // Simpan data peminjaman
            $peminjaman->save();
            
            // dd($validated['data_peminjaman']);
            // Simpan data peminjaman barang ke tabel td_peminjaman_barang
            foreach ($validated['data_peminjaman'] as $index => $item) {
                $pbd_id = $pb_id . str_pad($index + 1, 4, '0', STR_PAD_LEFT);

                // Menyimpan peminjaman barang
                DB::table('td_peminjaman_barang')->insert([
                    'pbd_id' => $pbd_id,
                    'pb_id' => $peminjaman->pb_id,  // Gunakan pb_id yang baru disimpan
                    'br_kode' => $item['br_kode'],
                    'pdb_tgl' => now(),
                    'pdb_sts' => '1', // Set status peminjaman barang
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                // Mencari data barang berdasarkan ID
            $barang = BarangInventaris::findOrFail($item['br_kode']);

            // Memperbarui data barang
            $barang->update([
                'br_status' => $request->input('0'),
            ]);
            }

            // Commit transaksi
            DB::commit();
            
            // Redirect ke halaman peminjaman dengan pesan sukses
            return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil disimpan!');
        } catch (\Throwable $th) {
            // Rollback jika ada error
            DB::rollBack();
            Log::error($th->getMessage());
            return redirect()->back()->withErrors(['data' => 'Data gagal ditambah']);
        }
    }

    public function detail($id)
    {
        $daftarPeminjaman = Peminjaman::findOrFail($id);
        $detailPeminjaman = PeminjamanBarang::with('barangInventaris')->where('pb_id', $id)->get();
        $daftarBarangs = BarangInventaris::all();

        return view('peminjaman.detail', compact('daftarPeminjaman', 'detailPeminjaman', 'daftarBarangs'));
    }

}

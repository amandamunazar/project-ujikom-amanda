<?php

namespace App\Http\Controllers;

use App\Models\BarangInventaris;
use App\Models\JenisBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BarangInventarisController extends Controller
{
    // Menampilkan daftar barang
    public function index()
    {
        // $barang = BarangInventaris::all();
        $data['barangInventaris'] = BarangInventaris::all();
        $data['user'] = Auth::user()->user_nama; 

        // <option value="1">Barang Kondisi Baik</option>
        //         <option value="2">Barang Rusak, Bisa Diperbaiki</option>
        //         <option value="3">Barang Rusak, Tidak Bisa Diperbaiki</option>
        //         <option value="0">Barang Dihapus dari Sistem</option>
        foreach ($data['barangInventaris'] as $barang){
            switch ($barang->br_status) {
                case 1:
                    $barang->br_status = 'Baik';
                    break;
                case 2:
                    $barang->br_status = 'Rusak, dapat diperbaiki';
                    break;
                case 3:
                    $barang->br_status = 'Rusak, tidak dapat diperbaiki';
                    break;
                default:
                    $barang->br_status = 'Tidak Diketahui';
                    break;
            }
        }
        // $jenis = JenisBarang::all();
        
        // return view('barang.index', compact('barang'));
        return view('barang.index')->with($data);
    }

    // Menampilkan form untuk menambahkan barang baru
    public function create()
    {
        $jenisBarang = JenisBarang::all();
        return view('barang.create', compact('jenisBarang'));
    }

    // Menyimpan data barang baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jns_brg_kode' => 'required',
            'br_nama' => 'required|string|max:255',
            'br_tgl_terima' => 'required|date',
            'br_status' => 'required|in:0,1,2,3',
        ]);
        
        $user_id = Auth::user()->user_id;
        $validated['user_id'] = $user_id;
        $validated['br_tgl_entry'] = now();
        $validated['br_kode'] = BarangInventaris::generateKodeBarang();
        $validated['br_tgl_terima'] = $request->input('br_tgl_terima');

        BarangInventaris::create($validated);
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit data barang
    public function edit($id)
    {
        $barang = BarangInventaris::findOrFail($id);
        $jenisBarang = JenisBarang::all();
        return view('barang.edit', compact('barang', 'jenisBarang'));
    }

    // Memperbarui data barang di database
    public function update(Request $request, $br_kode)
    {
        // Validasi input
        $request->validate([
            'br_nama' => 'required|string|max:50',
            'br_status' => 'required|string|max:2',
        ]);

        try {
            // Mencari data barang berdasarkan ID
            $barang = BarangInventaris::findOrFail($br_kode);

            // Memperbarui data barang
            $barang->update([
                'br_nama' => $request->input('br_nama'),
                'br_status' => $request->input('br_status'),
            ]);

            return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat memperbarui data barang: ' . $e->getMessage()]);
        }
    }

    // Menghapus data barang dari database
    public function destroy($id)
    {
        try {
            // Mencari data barang berdasarkan ID
            $barang = BarangInventaris::findOrFail($id);

            // Menghapus data barang
            $barang->delete();

            return redirect()->route('barang.index')->with('success', 'Data barang berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data barang: ' . $e->getMessage()]);
        }
    }

    // Fungsi untuk menghasilkan kode barang unik
    private function generateBrKode()
    {
        $currentYear = date('Y'); // Mendapatkan tahun saat ini
        $prefix = 'INV'; // Prefix kode barang

        // Mendapatkan nomor urut terakhir untuk tahun saat ini
        $maxKode = DB::table('tm_barang_inventaris')
            ->select(DB::raw("IFNULL(MAX(CAST(SUBSTRING(br_kode, 8, 5) AS UNSIGNED)), 0) + 1 AS next_kode"))
            ->whereRaw("SUBSTRING(br_kode, 4, 4) = ?", [$currentYear])
            ->value('next_kode');

        // Mengembalikan format kode barang
        return sprintf("%s%s%05d", $prefix, $currentYear, $maxKode);
    }
}

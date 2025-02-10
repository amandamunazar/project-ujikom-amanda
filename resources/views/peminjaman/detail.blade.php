@extends('layouts.layout')
@section('title', 'Daftar Peminjaman Barang')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Peminjaman Barang</h6> <br>
            <a href="{{ route('peminjaman.create')}}" class="btn btn-primary">Tambah Peminjaman</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tbody>
                                <tr>
                                    <th style="width: 20%;">PEMINJAMAN ID</th>
                                    <td>{{ $daftarPeminjaman->pb_id }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 20%;">USER ID</th>
                                    <td>{{ $daftarPeminjaman->user_id }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 20%;">NO SISWA</th>
                                    <td>{{ $daftarPeminjaman->pb_no_siswa }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 20%;">NAMA SISWA</th>
                                    <td>{{ $daftarPeminjaman->pb_nama_siswa }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 20%;">TANGGAL PEMINJAMAN</th>
                                    <td>{{ $daftarPeminjaman->pb_tgl }}</td>
                                </tr>
                                <tr>
                                    <th style="width: 20%;">TANGGAL PENGEMBALIAN</th>
                                    <td>{{ $daftarPeminjaman->pb_harus_kembali_tgl }}</td>
                                </tr>
                                {{-- <tr>
                                    <th style="width: 20%;">NAMA BARANG</th>
                                    <td colspan="3">{{ $daftarPeminjaman->detailPeminjaman->br_kode}}</td>
                                </tr> --}}
                            </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

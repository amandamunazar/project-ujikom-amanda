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
                    <thead>
                        <tr>
                            <th>Kode Peminjaman</th>
                            <th>Tanggal Peminjaman</th>
                            <th>Nama Peminjam</th>
                            <th>Tanggal Pengembalian</th>   
                            <th>Status</th>
                            <th>Aksi</th>
                            <th>Kembali</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peminjaman as $item)
                        <tr>
                            <td>{{ $item->pb_id }}</td>
                            <td>{{ $item->pb_tgl }}</td>
                            <td>{{ $item->pb_nama_siswa }}</td>
                            <td>{{ $item->pb_harus_kembali_tgl }}</td>
                            <td>
                                @if($item->status == 1)
                                    <span class="badge badge-success">Tidak</span>
                                @else
                                    <span class="badge badge-secondary">Aktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('peminjaman.detail', $item->pb_id) }}"
                                    class="btn btn-small btn-success w-100" title="Detail">
                                <span class="icon text-white">Lihat</span>
                            </a>
                            </td>
                            <td>
                                <button class="btn btn-success btn-sm" 
                                    data-id="{{ $item->pb_id }}">
                                    Kembalikan
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

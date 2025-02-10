@extends('layouts.layout')
@section('title', 'Daftar Barang')

@section('content')


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Daftar Barang</h6> <br>
                            <a href="{{ route( 'barang.create') }}" class="btn btn-primary">Tambah Daftar Barang </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama Barang</th>
                                            <th>Jenis Barang</th>
                                            <th>Barang Tanggal Terima</th>
                                            <th>Barang Tanggal Entry</th>
                                            <th>Kondisi Barang</th>
                                            <th>Status Barang</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    {{-- <tfoot>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Tanggal Terima</th>
                                            <th>Tanggal Entry</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot> --}}
                                    <tbody>
                                        @foreach($barangInventaris as $index => $barang)
                                        <tr>
                                            <td>{{ $barang->br_kode }}</td>
                                            <td>{{ $barang->br_nama }}</td>
                                            <td>{{ $barang->jenis_barang->jns_brg_kode}}</td>
                                            <td>{{ $barang->br_tgl_terima }}</td>
                                            <td>{{ $barang->br_tgl_entry }}</td>
                                            <td>{{ $barang->br_status }}</td>
                                            <td>{{ $barang->br_status = 1 ? 'Tersedia' : 'Dipinjam' }}</td>
                                            <td>
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('barang.edit', $barang->br_kode) }}" class="btn btn-warning btn-sm">Edit</a>

                                                <!-- Form Hapus -->
                                                <form action="{{ route('barang.destroy', $barang->br_kode) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

@endsection

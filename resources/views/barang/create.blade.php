@extends('layouts.layout')

@section('content')
<div class="container">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
        
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1>Tambah Barang Inventaris</h1>
    <form action="{{ route('barang.store') }}" method="POST">
        @csrf
        <!-- Nama Barang -->
        <div class="mb-3">
            <label for="br_nama" class="form-label">Nama barang</label>
            <input type="text" name="br_nama" id="br_nama" class="form-control" maxlength="50" required>
        </div>

        <div class="form-group">
            <label for="jns_brg_kode">Jenis Barang</label>
            <select class="form-control" id="jns_brg_kode" name="jns_brg_kode" required>
    <option value="" disabled selected>Pilih Jenis Barang</option>
    @foreach ($jenisBarang as $jenis)
        <option value="{{ $jenis->jns_brg_kode}}">{{ $jenis->jns_brg_nama}}</option>
    @endforeach
</select>

        </div>

        <!-- Tanggal Terima -->
        <div class="mb-3">
            <label for="br_tgl_terima" class="form-label">Tanggal Diterima</label>
            <input type="date" name="br_tgl_terima" id="br_tgl_terima" class="form-control" required>
        </div>


        <!-- Status Barang -->
        <div class="mb-3">
            <label for="br_status" class="form-label">Status Barang</label>
            <select name="br_status" id="br_status" class="form-control" required>
                <option value="" disabled selected>Pilih Status Barang</option>
                <option value="1">Barang Kondisi Baik</option>
                <option value="2">Barang Rusak, Bisa Diperbaiki</option>
                <option value="3">Barang Rusak, Tidak Bisa Diperbaiki</option>
                <option value="0">Barang Dihapus dari Sistem</option>
            </select>
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection

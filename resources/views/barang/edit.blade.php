@extends( 'layouts.layout')

@section( 'content')
    <h1>Edit Daftar Barang</h1>

<form action="{{ route('barang.update', $barang->br_kode) }}" method="POST">
    @csrf
    @method('PATCH')
        <div class="form-group">
            <label for="br_nama">Nama Barang</label>
            <input type="text" name="br_nama" id="br_nama" class="form-control" value="{{ $barang->br_nama }}" required>
        </div>

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

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endsection
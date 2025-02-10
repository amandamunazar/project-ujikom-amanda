@extends('layouts.layout') <!-- Pastikan Anda menggunakan layout yang sesuai -->

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Jenis Barang</div>

                <div class="card-body">
                    <!-- Tampilkan pesan error jika ada -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                   <form action="{{ route('jenis_barang.update', $jenisBarang->jns_brg_kode) }}" method="POST">
                    @csrf
                    @method('PATCH')

                        <div class="form-group">
                            <label for="jns_brg_nama">Nama Jenis Barang</label>
                            <input type="text" name="jns_brg_nama" id="jns_brg_nama" class="form-control" value="{{ $jenisBarang->jns_brg_nama }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

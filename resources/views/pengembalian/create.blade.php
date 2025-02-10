{{-- @extends('layouts.layout')
@section('title', 'Pengembalian Barang')

@section('content')
    <div class="page-body">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Form Pengembalian Barang</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('pengembalian.store') }}" method="POST">
                    @csrf
                    <!-- Input Peminjaman -->
                    <div class="form-group">
                        <label for="peminjaman"> ID Peminjaman</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="peminjaman_id" name="pb_id" 
                                   value="{{ old('pb_id', $selectedPbId ?? '') }}" readonly required>
                        </div>
                    </div>
                    <!-- Status Barang -->
                    <div class="form-group">
                        <label for="kembali_sts" class="col-form-label">Status Barang</label>
                        <div>
                            <select class="form-control" id="kembali_sts" name="kembali_sts" required>
                                <option value="" disabled selected>Pilih Status Barang</option>
                                <option value="0">Barang Kondisi Baik</option>
                                <option value="1">Barang Rusak</option>
                            </select>
                        </div>
                    </div>
                    <!-- Tombol -->
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('daftar-peminjaman.index')}}" class="btn btn-secondary me-1">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Peminjaman -->
    <div class="modal fade text-left" id="modalPeminjaman" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
            <div class="modal-content modal-centered">
                <div class="modal-header border-bottom bg-transparent">
                    <h4 class="modal-title">Data Peminjaman</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Peminjaman</th>
                                            <th>Nama Siswa</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Tanggal Harus Kembali</th>
                                            <th>Barang Dipinjam</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($peminjaman as $key => $data)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $data->pb_id }}</td>
                                                <td>{{ $data->pb_nama_siswa }}</td>
                                                <td>{{ $data->pb_tgl }}</td>
                                                <td>{{ $data->pb_harus_kembali_tgl }}</td>
                                                <td>
                                                    @foreach ($barangPinjaman as $barang)
                                                        @if ($barang->pb_id == $data->pb_id)
                                                            {{ $barang->barangInventaris->br_nama }}
                                                        @endif
                                                    @endforeach
                                                </td>

                                                <td>
                                                    <button class="btn btn-primary btn-sm pilihPeminjaman"
                                                        data-id="{{ $data->pb_id }}"
                                                        data-nama="{{ $data->pb_nama_siswa }}">
                                                        Pilih
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal" aria-label="Close">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Script untuk Memilih Data -->
    <script>
        $(document).on('click', '.pilihPeminjaman', function() {
            var pb_id = $(this).data('id'); // Ambil pb_id dari tombol

            // Masukkan pb_id ke dalam input
            $('#peminjaman_id').val(pb_id);

            // Tutup modal setelah memilih
            $('#modalPeminjaman').modal('hide');
        });
    </script>
@endsection --}}
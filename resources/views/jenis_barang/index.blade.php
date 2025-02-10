@extends('layouts.layout')
@section('title', 'Jenis Barang')

@section('content')



                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Jenis Barang</h6> <br>
                            <a href="{{ route( 'jenis_barang.create') }}" class="btn btn-primary">Tambah Jenis Barang </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($jenisBarangs as $jenisBarang)
                                        <tr>
                                            <td>{{ $jenisBarang->jns_brg_kode }}</td>
                                            <td>{{ $jenisBarang->jns_brg_nama }}</td>
                                            <td>
                                                <!-- Tombol Edit -->
                                                <a href="{{ route('jenis_barang.edit', $jenisBarang->jns_brg_kode) }}" class="btn btn-warning btn-sm">Edit</a>

                                                <!-- Form Hapus -->
                                                <form action="{{ route('jenis_barang.destroy', $jenisBarang->jns_brg_kode) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                    <!-- SweetAlert Script -->
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                        document.querySelectorAll('.delete-button').forEach(button => {
                            button.addEventListener('click', function() {
                                Swal.fire({
                                    title: 'Apakah Anda yakin?',
                                    text: "Data ini akan dihapus secara permanen!",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ya, hapus!',
                                    cancelButtonText: 'Batal'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        this.closest('form').submit();
                                    }
                                })
                            });
                        });
                    </script>

@endsection

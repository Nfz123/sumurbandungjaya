@extends('sbj.main')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Daftar Type</h5>

                        <!-- Table with stripped rows -->
                        <a href="{{ route('Typebarang.create') }}" type="button" class="btn btn-primary">+Tambah Type</a>
                        <table id="typebarang-table" class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="5%">AKSI</th>
                                    <th scope="col" width="30%">TYPE</th>
                                    <th scope="col" width="10%">UOM</th>
                                    <th scope="col" width="20%">HARGA LAMA</th>
                                    <th scope="col" width="10%">HARGA BARU</th>
                                    <th scope="col" width="10%">PPN</th>
                                    <th scope="col" width="30%">HARGA JUAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($typebarang as $item) 
                                <tr>
                                    <td>
                                        <button type="button" class="btn btn-outline-primary btn-block"><i class="fa fa-bell"></i>Edit</button>
                                        <button type="button" class="btn btn-outline-primary btn-block"><i class="fa fa-bell"></i>Delete</button>
                                    </td>
                                    <td>{{$item->namatype}}</td>
                                    <td>{{$item->uom}}</td>
                                    <td>{{number_format($item->hargalama, 0, ',', '.')}}</td>
                                    <td>{{number_format($item->hargabaru, 0, ',', '.')}}</td>
                                    <td>{{number_format($item->ppn, 0, ',', '.')}}</td>
                                    <td>{{number_format($item->hargajual, 0, ',', '.')}}</td>
                                    {{-- <td>{{$item->hargabaru}}</td> --}}
                                    {{-- <td>{{$item->ppn}}</td> --}}
                                    {{-- <td>{{$item->hargajual}}</td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>



                        <!-- End Table with stripped rows -->
                        <!-- Edit Modal -->
                        <!-- Tambahkan modal edit di dalam kode HTML Anda -->
                        <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                            aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editForm" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="namatypeInput">Nama Type</label>
                                                <input type="text" class="form-control" id="namatypeInput"
                                                    name="namatype" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="satuanInput">Satuan</label>
                                                <input type="text" class="form-control" id="satuanInput" name="satuan"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </section>
@endsection
@push('scripts')
  
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#typebarang-table').DataTable();
    });
</script>
    <script>
        function hapusData(id) {
            if (confirm("Anda yakin ingin menghapus data ini?")) {
                $.ajax({
                    url: '/data/hapus/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        // Tindakan yang dilakukan setelah data dihapus
                        alert('Data berhasil dihapus.');
                        location.reload(); // Memuat ulang halaman
                    },
                    error: function(xhr) {
                        // Tindakan yang dilakukan jika terjadi kesalahan
                        alert('Terjadi kesalahan. Data gagal dihapus.');
                    }
                });
            }
        }
    </script>
    <script>
        function editData(id) {
            $.ajax({
                url: '/Typebarang/edit/' + id,
                type: 'GET',
                success: function(response) {
                    // Tindakan yang dilakukan setelah data diterima
                    $('#editModal').modal('show');
                    $('#editForm').attr('action', '/data/update/' + id);
                    $('#namatypeInput').val(response.namatype);
                    $('#satuanInput').val(response.satuan);
                },
                error: function(xhr) {
                    // Tindakan yang dilakukan jika terjadi kesalahan
                    alert('Terjadi kesalahan. Data tidak dapat diedit.');
                }
            });
        }
    </script>
@endpush

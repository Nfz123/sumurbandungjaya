@extends('sbj.main')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="card-title m-0">Daftar Type</h5>
                                <a href="{{ route('Typebarang.create') }}" class="btn btn-primary">+ Tambah Type</a>
                            </div>

                            <!-- Input pencarian -->
                            <div class="mb-3">
                                <input type="text" id="searchInput" class="form-control" placeholder="Cari berdasarkan type, merek, atau no rangka...">
                            </div>

                            <div class="table-responsive"  style="overflow-x:auto;">
                            <table id="typeTable" class="table table-bordered table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Aksi</th>
                                        <th>Gambar</th>
                                        <th>Type</th>
                                        <th>Merek</th>
                                        <th>No Rangka</th>
                                        <th>No Mesin</th>
                                        <th>Pajak Tahun</th>
                                        <th>Pajak Kir</th>
                                    </tr>
                                </thead>
                                <tbody id="typeTableBody">
                                    @foreach ($typebarang as $item)
                                    <tr>
                                        <td class="text-wrap">
                                            <button type="button" class="btn btn-sm btn-outline-primary edit-btn" data-id="{{ $item->id }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-btn" data-id="{{ $item->id }}">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                        </td>
                                        <td class="text-wrap">
                                            @if ($item->gambar)
                                                <img src="{{ asset('storage/typebarang/' . $item->gambar) }}" width="80" class="img-thumbnail">
                                            @else
                                                <small class="text-muted">Tidak ada gambar</small>
                                            @endif
                                        </td>
                                        <td class="text-wrap">{{ $item->namatype }}</td>
                                        <td class="text-wrap">{{ $item->merek }}</td>
                                        <td class="text-wrap">{{ $item->no_rangka }}</td>
                                        <td class="text-wrap">{{ $item->no_mesin }}</td>
                                        <td class="text-wrap">{{ $item->pajak_tahun }}</td>
                                        <td class="text-wrap">{{ $item->pajak_kir }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
            <!-- Edit Modal -->
            <!-- Modal Edit -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="editForm" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Type Barang</h5>
                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="edit_id">
                                <div class="form-group">
                                    <label>Gambar Saat Ini</label><br>
                                    <img id="editPreviewGambar" src="" width="120" class="mb-2 border">
                                </div>
                                <div class="form-group">
                                    <label>Ganti Gambar</label>
                                    <input type="file" name="gambar" id="editGambar" class="form-control-file">
                                </div>
                                <div class="form-group">
                                    <label>Nama Type</label>
                                    <input type="text" name="namatype" id="namatype" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="uom">Merek</label>
                                    <input type="text" class="form-control" id="merek" name="merek">
                                </div>
                                <div class="form-group">
                                    <label for="hargalama">No Rangka</label>
                                    <input type="text" class="form-control" id="no_rangka" name="no_rangka">
                                </div>
                                <div class="form-group">
                                    <label for="hargabaru">No Mesin</label>
                                    <input type="text" class="form-control" id="no_mesin" name="no_mesin">
                                </div>
                                <div class="form-group">
                                    <label for="ppn">Pajak Tahun</label>
                                    <input type="text" class="form-control" id="pajak_tahun" name="pajak_tahun">
                                </div>
                                <div class="form-group">
                                    <label for="hargajual">Pajak Kir</label>
                                    <input type="text" class="form-control" id="pajak_kir" name="pajak_kir">
                                </div>
                                <!-- Tambahkan field lain seperti merek, no_rangka, dll -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    </section>
@endsection
@push('scripts')
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Include Bootstrap JS (make sure to include the popper.js dependency as well) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#typebarang-table').DataTable();
        });
        $(document).ready(function() {
            // Tampilkan data ke modal
            $('.btn-outline-primary').on('click', function() {
                var itemId = $(this).data('id');

                $.get('/getTypebarang/' + itemId, function(data) {
                    $('#edit_id').val(data.id);
                    $('#editPreviewGambar').attr('src', '/storage/typebarang/' + data.gambar);
                    $('#namatype').val(data.namatype);
                      $('#merek').val(data.merek);
                    $('#no_rangka').val(data.no_rangka);
                    $('#no_mesin').val(data.no_mesin);
                    $('#pajak_tahun').val(data.pajak_tahun);
                    $('#pajak_kir').val(data.pajak_kir);
                    $('#editModal').modal('show');
                });
            });

            // Submit form edit
            $('#editForm').on('submit', function(e) {
                e.preventDefault();
                var id = $('#edit_id').val();
                var formData = new FormData(this);

                $.ajax({
                    url: '/updateTypebarang/' + id,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function() {
                        $('#editModal').modal('hide');
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('Gagal menyimpan data.');
                        console.log(xhr.responseText);
                    }
                });
            });
        });

       
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.delete-btn').on('click', function() {
                var itemId = $(this).data('id');

                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    // Lakukan permintaan Ajax untuk menghapus data
                    $.ajax({
                        url: '/deleteTypebarang/' + itemId, // Ganti dengan rute yang sesuai
                        type: 'DELETE',
                        success: function() {
                            // Redirect ke halaman index jika penghapusan berhasil
                            window.location.href = "{{ route('Typebarang.index') }}";
                            // Tampilkan pesan
                            $('#delete-success-message').show();
                        }
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#searchInput').on('keyup', function() {
                let value = $(this).val().toLowerCase();
                $('#typeTableBody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });

            // Inisialisasi DataTables opsional
            // $('#typeTable').DataTable(); 
        });
    </script>
@endpush
@push('styles')
<style>
    td {
        vertical-align: middle;
    }

    td.text-wrap {
        white-space: normal !important;
        word-break: break-word;
        max-width: 150px;
    }

    .table img {
        max-width: 100px;
        height: auto;
    }

    @media (max-width: 768px) {
        td {
            font-size: 12px;
        }
    }
</style>
@endpush


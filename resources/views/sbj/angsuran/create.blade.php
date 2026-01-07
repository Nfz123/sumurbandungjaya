@extends('sbj.main')
@section('content')
        <div class="container mt-2">
            <h3>INPUT ANGSURAN</h3>
            <form id="formAngsuran" action="{{ route('angsuran.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group mb-3">
                        <label for="kode_transaksi">Kode Type</label>
                        <input type="text" class="form-control" name="kode_id" id="id" hidden>
                        <input type="text" class="form-control" name="kodetype" id="kode" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label for="kendaraan">Kendaraan</label>
                        <div class="row g-2">
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="namatype" id="nama" required>
                            </div>
                            <div class="col-md-3">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#kendaraanModal">
                                    Select
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="tanggal_angsuran">Tanggal Angsuran</label>
                        <input type="date" class="form-control" name="tanggal_angsuran" id="tanggal_angsuran" required>
                    </div>
                      <div class="form-group mb-3">
                        <label for="tanggal_angsuran">Nominal Angsuran</label>
                        <input type="text" class="form-control" name="nominal_angsuran" id="nominal" readonly>
                    </div>
                     <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" id="btnBatal">Batal</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="kendaraanModal" tabindex="-1" aria-labelledby="kendaraanModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="kendaraanModal">Pilih Kendaraan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Kode</th>
                                    <th>Nama Type</th>
                                     <th>Nominal Angsuran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                            @foreach($typebarang as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->kodetype }}</td>
                                <td>{{ $item->namatype }}</td>
                                  <td>{{ $item->nominal_angsuran }}</td>
                                <td>
                                    <button class="btn btn-success btn-sm btn-select" 
                                            data-id="{{ $item->id }}" 
                                            data-kode="{{ $item->kodetype }}" 
                                            data-nama="{{ $item->namatype }}"
                                            data-nominal="{{ $item->nominal_angsuran }}">
                                        Select
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
@endsection

@push('scripts')
  
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
       <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>

     <script>
        $(document).on('click', '.btn-select', function() {
             var id = $(this).data('id');
            var kode = $(this).data('kode');
            var nama = $(this).data('nama');
              var nominal = $(this).data('nominal');

            $('#id').val(id);
              $('#kode').val(kode);
            $('#nama').val(nama);
             $('#nominal').val(nominal);

            $('#kendaraanModal').modal('hide');
        });
</script>
<script>

    $('#nominal').on('input', function () {
        let value = $(this).val().replace(/[^\d]/g, ''); // hanya angka
        if (value) {
            $(this).val(formatRupiah(value));
        } else {
            $(this).val('');
        }
    });
</script>
<script>
    $('#btnBatal').on('click', function () {
        $('#formAngsuran')[0].reset(); // reset semua input
        // Jika ada input readonly yang tidak ter-reset, kosongkan manual
        $('#kode').val('');
        $('#nama').val('');
        $('#nominal').val('');
    });
</script>

@endpush
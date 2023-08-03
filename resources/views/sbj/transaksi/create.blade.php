@extends('sbj.main')
@section('content')
    {{-- @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
    @endpush --}}

    <div class="container mt-5">
        <h2>INPUT DATA MASUK</h2>


        <form id="addRowForm">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputFile">Nomor</label>
                    <input type="text" class="form-control" name="kode_transaksi" value="{{$doku}}" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Tanggal</label>
                    <input type="date" class="form-control datetimepicker-input" name="tanggal" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">Perusahaan</label>
                    <input type="text" class="form-control" name="perusahaan" required>
                </div>
            </div>

            <table class="table" id="rowTable">
                <thead>
                    <tr>
                        <th>Kode Type</th>
                        <th>Nama Type</th>
                        <th>UOM</th>
                        <th>Qty</th>
                        <th>PPN</th>
                        <th>HARGA JUAL</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="row0">
                        <td><input type="text" name="kodetype[]" class="form-control"></td>
                        <td><input type="text" name="namatype[]" class="form-control"></td>
                        <td><input type="text" name="uom[]" class="form-control"></td>
                        <td><input type="text" name="qty[]" class="form-control"></td>
                        <td><input type="text" name="ppn[]" class="form-control"></td>
                        <td><input type="text" name="hargajual[]" class="form-control"></td>
                        <td>
                            <button type="button" class="btn btn-primary" onclick="showModalData(0)">Select</button>
                            <button type="button" class="btn btn-danger" onclick="removeRow(0)">Remove</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <a class="btn btn-primary mt-3" onclick="addRow()">Add Row</a>
            <button type="submit" class="btn btn-success mt-3">Simpan</button>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dataModalLabel">Data Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="searchInput" placeholder="Search">
                    </div>
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Kode Type</th>
                                <th>Nama Type</th>
                                <th>UOM</th>
                                <th>qty</th>
                                <th>PPN</th>
                                <th>HARGA JUAL</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="modalBody">
                            <!-- Data will be populated here -->
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        var rowCount = 1;

        function addRow() {
            var row = `<tr id="row${rowCount}">
                            <td><input type="text" name="kodetype[]" class="form-control"></td>
                            <td><input type="text" name="namatype[]" class="form-control"></td>
                            <td><input type="text" name="uom[]" class="form-control"></td>
                            <td><input type="text" name="qty[]" class="form-control"></td>
                            <td><input type="text" name="ppn[]" class="form-control"></td>
                            <td><input type="text" name="hargajual[]" class="form-control"></td>
                            <td>
                                <button type="button" class="btn btn-primary" onclick="showModalData(${rowCount})">Select</button>
                                <button type="button" class="btn btn-danger" onclick="removeRow(${rowCount})">Remove</button>
                            </td>
                        </tr>`;

            $('#rowTable tbody').append(row);
            rowCount++;
        }

        function removeRow(rowId) {
            $('#row' + rowId).remove();
        }

        $('#addRowForm').submit(function(event) {
            event.preventDefault();
            var formData = $(this).serialize();
            // console.log(formData);

            // Tambahkan CSRF token pada data
            formData += '&_token=' + '{{ csrf_token() }}';

            // Lakukan request AJAX untuk menyimpan data ke server
            $.ajax({
                url: '/simpantrans',
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Lakukan sesuatu setelah data berhasil disimpan
                    // if (response.success) {
                    //     // Pesan berhasil disimpan
                        alert('Data berhasil disimpan.');
                        // window.location.href = '/home'; // Mengarahkan ke halaman "/dashboard"
                    //     // Kembali ke halaman sebelumnya
                    //     // window.history.back();
                    // } else {
                    //     // Pesan gagal disimpan (jika diperlukan)
                    //     alert('Gagal menyimpan data. Respon: ' + response);
                    // }
                },
                error: function() {
                    // Pesan gagal disimpan (jika diperlukan)
                    alert('Terjadi kesalahan saat menyimpan data.');
                }
            });


        });


        function showModalData(rowId) {
            var kodetype = $('input[name="kodetype[]"]').eq(rowId).val();
            var namatype = $('input[name="namatype[]"]').eq(rowId).val();
            var uom = $('input[name="uom[]"]').eq(rowId).val();
            var qty = $('input[name="qty[]"]').eq(rowId).val();
            var ppn = $('input[name="ppn[]"]').eq(rowId).val();
            var hargajual = $('input[name="hargajual[]"]').eq(rowId).val();

            // Panggil endpoint di sisi server dengan AJAX
            $.ajax({
                url: '/getData', // Ganti dengan URL endpoint yang sesuai di sisi server
                method: 'GET',
                data: {
                    kodetype: kodetype,
                    namatype: namatype,
                    uom: uom,
                    qty: qty,
                    ppn: ppn,
                    hargajual: hargajual
                },
                success: function(response) {
                    // Tampilkan data yang diterima dalam modal
                    populateModalData(response, rowId);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }

        function populateModalData(data, rowId) {
            $('#modalBody').empty();
            var rows = '';
            for (var i = 0; i < data.length; i++) {
                rows += '<tr>';
                rows += '<td>' + data[i].kodetype + '</td>';
                rows += '<td>' + data[i].namatype + '</td>';
                rows += '<td>' + data[i].uom + '</td>';
                rows += '<td>' + data[i].qty + '</td>';
                rows += '<td>' + data[i].ppn + '</td>';
                rows += '<td>' + data[i].hargajual + '</td>';
                rows += '<td><button type="button" class="btn btn-primary" onclick="selectData(' + rowId + ', ' + i +
                    ')">Select</button></td>';
                rows += '</tr>';
            }
            $('#modalBody').html(rows);
            $('#dataModal').modal('show');
        }

        function selectData(rowId, modalRowId) {
            var kodetype = $('#modalBody tr').eq(modalRowId).find('td').eq(0).text();
            var namatype = $('#modalBody tr').eq(modalRowId).find('td').eq(1).text();
            var uom = $('#modalBody tr').eq(modalRowId).find('td').eq(2).text();
            var qty = $('#modalBody tr').eq(modalRowId).find('td').eq(3).text();
            var ppn = $('#modalBody tr').eq(modalRowId).find('td').eq(4).text();
            var hargajual = $('#modalBody tr').eq(modalRowId).find('td').eq(4).text();

            var selectedRow = $('#row' + rowId);
            selectedRow.find('input[name="kodetype[]"]').val(kodetype);
            selectedRow.find('input[name="namatype[]"]').val(namatype);
            selectedRow.find('input[name="uom[]"]').val(uom);
            selectedRow.find('input[name="qty[]"]').val(qty);
            selectedRow.find('input[name="ppn[]"]').val(ppn);
            selectedRow.find('input[name="hargajual[]"]').val(ppn);

            $('#dataModal').modal('hide');
        }
    </script>
    <!-- Skrip DataTables -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
{{-- <script>
    $(document).ready(function() {
        // Inisialisasi DataTables
        var table = $('#dataModalTable').DataTable();

        // Tambahkan fungsi pencarian
       // Tambahkan fungsi pencarian
       $('#searchInput').on('keyup', function() {
            table.fnFilter(this.value);
        });
    });
</script> --}}

@endsection
@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endpush

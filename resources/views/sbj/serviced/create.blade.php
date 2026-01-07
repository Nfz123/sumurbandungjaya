@extends('sbj.main')
@section('content')
<div class="container mt-5">
    <h2>Input Service</h2>

   <form id="addRowForm">
    @csrf
    <div class="card-body p-2">
        <div class="row">
            <div class="col-md-4 mb-2">
                <label class="small">Nomor</label>
                <input type="text" class="form-control form-control-sm" name="kode_serviced" value="{{ $doku }}" readonly>
            </div>
            <div class="col-md-4 mb-2">
                <label class="small">Tanggal</label>
                <input type="date" class="form-control form-control-sm" name="tanggal" required>
            </div>
            <div class="col-md-4 mb-2">
                {{-- <label class="small">Perusahaan</label> --}}
                <input type="hidden" class="form-control form-control-sm" name="perusahaan" value="PT. SBJ Ekspedisi"  required>
            </div>
        </div>
    </div>

    <div class="table-responsive p-1">
    <table class="table table-sm table-bordered mb-0" id="rowTable">
        <thead class="thead-light text-center small">
            <tr>
                <th class="align-middle">Kode</th>
                <th class="align-middle">Kendaraan</th>
                <th class="align-middle">Barang</th>
                <th class="align-middle">Qty</th>
                <th class="align-middle">Harga</th>
                <th class="align-middle">Total</th>
                <th class="align-middle">#</th>
            </tr>
        </thead>
        <tbody>
            <tr id="row0">
                <td><input type="text" name="kodetype[]" class="form-control form-control-sm"></td>
                <td><input type="text" name="namatype[]" class="form-control form-control-sm"></td>
                <td><input type="text" name="barang[]" class="form-control form-control-sm"></td>
                <td><input type="number" name="qty[]" class="form-control form-control-sm" min="0"></td>
                <td><input type="number" name="harga[]" class="form-control form-control-sm" min="0"></td>
                <td><input type="text" name="total[]" class="form-control form-control-sm" readonly></td>
                <td class="text-center">
                    <button type="button" class="btn btn-xs btn-outline-primary" onclick="showModalData(0)">
                        <i class="fas fa-search fa-xs"></i>
                    </button>
                    <button type="button" class="btn btn-xs btn-outline-danger" onclick="removeRow(0)">
                        <i class="fas fa-trash fa-xs"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>


    <div class="d-flex gap-2 mt-2">
        <a class="btn btn-sm btn-primary me-2" onclick="addRow()">+ Add Row</a>
        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
    </div>
</form>


</div>

<!-- Modal -->
<div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Data Detail</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control mb-3" id="searchInput" placeholder="Search">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Kode Kendaraan</th>
                                <th>Kendaraan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="modalBody"></tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Script --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });

    let rowCount = 1;

    function addRow() {
        var row = `
        <tr id="row${rowCount}">
            <td><input type="text" name="kodetype[]" class="form-control form-control-sm"></td>
            <td><input type="text" name="namatype[]" class="form-control form-control-sm"></td>
            <td><input type="text" name="barang[]" class="form-control form-control-sm"></td>
            <td><input type="number" name="qty[]" class="form-control form-control-sm" min="0"></td>
            <td><input type="number" name="harga[]" class="form-control form-control-sm" min="0"></td>
            <td><input type="text" name="total[]" class="form-control form-control-sm" readonly></td>
            <td class="text-center">
                <button type="button" class="btn btn-xs btn-outline-primary" onclick="showModalData(${rowCount})">
                    <i class="fas fa-search fa-xs"></i>
                </button>
                <button type="button" class="btn btn-xs btn-outline-danger" onclick="removeRow(${rowCount})">
                    <i class="fas fa-trash-alt fa-xs"></i>
                </button>
            </td>
        </tr>`;
        $('#rowTable tbody').append(row);
        rowCount++;
    }

    function removeRow(rowId) {
        $(`#row${rowId}`).remove();
    }

    $('#addRowForm').on('submit', function (e) {
        e.preventDefault();
        const formData = $(this).serialize();

        $.post('/simpanserviced', formData)
            .done(function (response) {
                alert('Data berhasil disimpan.');
                window.location.href = "{{ route('serviced.laporanServiced') }}";
            })
            .fail(function (xhr) {
                console.error(xhr.responseText);
                alert('Terjadi kesalahan saat menyimpan data.');
            });
    });

    function showModalData(rowId) {
        $.get('/getData', {}, function (data) {
            populateModalData(data, rowId);
        });
    }

    function populateModalData(data, rowId) {
        let rows = '';
        data.forEach((item, i) => {
            rows += `
                <tr>
                    <td>${item.kodetype}</td>
                    <td>${item.namatype}</td>
                    <td><button type="button" class="btn btn-primary" onclick="selectData(${rowId}, ${i})">Select</button></td>
                </tr>`;
        });
        $('#modalBody').html(rows);
        $('#dataModal').modal('show');
    }

    function selectData(rowId, modalRowId) {
        const selected = $('#modalBody tr').eq(modalRowId);
        const kodetype = selected.find('td').eq(0).text();
        const namatype = selected.find('td').eq(1).text();

        const targetRow = $(`#row${rowId}`);
        targetRow.find('input[name="kodetype[]"]').val(kodetype);
        targetRow.find('input[name="namatype[]"]').val(namatype);

        $('#dataModal').modal('hide');
    }

    // Hitung total otomatis
    $(document).on('input', 'input[name="qty[]"], input[name="harga[]"]', function () {
        const row = $(this).closest('tr');
        const qty = parseFloat(row.find('input[name="qty[]"]').val()) || 0;
        const harga = parseFloat(row.find('input[name="harga[]"]').val()) || 0;
        row.find('input[name="total[]"]').val(qty * harga);
    });
</script>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<style>
    .form-control-sm, .btn-sm {
        font-size: 12px;
        padding: 0.25rem 0.4rem;
    }
    th, td {
        padding: 0.35rem !important;
        font-size: 12px;
    }
</style>
<style>
    .btn-xs {
    padding: 0.15rem 0.35rem;
    font-size: 0.65rem;
    line-height: 1;
    border-radius: 0.2rem;
}
</style>
@endpush

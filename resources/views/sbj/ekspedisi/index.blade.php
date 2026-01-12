@extends('sbj.main')
@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="col-12 col-sm-6 col-md-3 mb-3">
                            <div class="card p-3">
                                <input type="text" id="no_seri" class="form-control" placeholder="No Seri">
                                <input type="text" id="namasupir" class="form-control" placeholder="Nama Supir">
                                <input type="date" id="tanggal" class="form-control">

                                <button id="filter" class="btn btn-primary">Filter</button>
                                <button id="buat" class="btn btn-primary">Buat Invoice</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="ekspedisi-table" class="table table-bordered table-striped w-100">
                                <thead>
                                    <tr>
                                        <th style="display:none">ID</th>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Alias</th>
                                        <th>No Seri</th>
                                        <th>Supir</th>
                                        <th>SO</th>
                                        <th>Gudang</th>
                                        <th>Tujuan</th>
                                        <th>Qty terima</th>
                                        <th>Qty tolak</th>
                                        <th>TKBM</th>
                                        <th>Uang Jalan</th>
                                        <th>Ritasi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('styles')
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/jquery.dataTables.min.css') }}">
@endpush
@push('scripts')
    <!-- JS -->
    <script src="{{ asset('assets/bootstrap/js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap/js/dataTables.responsive.min.js') }}"></script>


<script>
    $(function () {
    let table = $('#ekspedisi-table').DataTable({
        processing: true,
        serverSide: true,
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        autoWidth: true,
        ajax: {
            url: "{{ route('ekspedisi.index') }}",
            data: function (d) {
                d.no_seri = $('#no_seri').val();
                d.namasupir = $('#namasupir').val();
                d.tanggal = $('#tanggal').val();
            }
        },
        columns: [
            {
                data: 'ekspedisi_id',
                visible: false,    // 🔥 HIDE
                searchable: false  // 🔥 tidak ikut search
            },
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { 
                data: 'tanggal',
                render: function(data, type, row) {
                    if (!data) return '';
                    let date = new Date(data);
                    let options = { day: '2-digit', month: 'short', year: 'numeric' };
                    return date.toLocaleDateString('id-ID', options); 
                    // Contoh output: 13 Jan 2026
                }
            },
            { data: 'nama_alias' },
            { data: 'no_seri' },
            { data: 'namasupir' },
            { data: 'nosalesorder' },
            { data: 'gudang' },
            { data: 'tujuan' },
            { data: 'qty_terima' },
            { data: 'qty_tolak' },
            {
                data: 'tkbm',
                render: function (data, type, row, meta) {
                    if (meta.row === 0) {
                        return data;
                    }

                    let table = $('#ekspedisi-table').DataTable();
                    let prevRow = table.row(meta.row - 1).data();

                    // ✅ tampil hanya jika beda ekspedisi
                    if (!prevRow || prevRow.ekspedisi_id !== row.ekspedisi_id) {
                        return data;
                    }

                    return '';
                }
            },
            {
                data: 'uangjalan',
                render: function (data, type, row, meta) {
                    if (meta.row === 0) {
                        return data;
                    }

                    let table = $('#ekspedisi-table').DataTable();
                    let prevRow = table.row(meta.row - 1).data();

                    // ✅ tampil hanya jika beda ekspedisi
                    if (!prevRow || prevRow.ekspedisi_id !== row.ekspedisi_id) {
                        return data;
                    }

                    return '';
                }
            },
            {
                data: 'hargaritasi',
                render: function (data, type, row, meta) {
                    if (meta.row === 0) {
                        return data;
                    }

                    let table = $('#ekspedisi-table').DataTable();
                    let prevRow = table.row(meta.row - 1).data();

                    // ✅ tampil hanya jika beda ekspedisi
                    if (!prevRow || prevRow.ekspedisi_id !== row.ekspedisi_id) {
                        return data;
                    }

                    return '';
                }
            }
        ]
    });

    $('#filter').click(function () {
        table.draw();
    });
});

</script>
@endpush


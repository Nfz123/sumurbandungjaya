@extends('sbj.main')
@section('title', 'Laporan Harian')
@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    {{-- <h5 class="card-title">Laporan Harian</h5> --}}
                    <!-- Table with stripped rows -->
                    <table id="typebarang-table" class="table">
                        <thead>
                            <tr>
                                <th scope="col" width="5%">NO TRANSAKSI</th>
                                <th scope="col" width="30%">TANGGAL</th>
                                <th scope="col" width="30%">TYPE</th>
                                <th scope="col" width="20%">UOM</th>
                                <th scope="col" width="20%">QTY</th>
                                <th scope="col" width="20%">Harga</th>
                                <th scope="col" width="20%">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksidetil as $item) 
                            <tr>
                                <td>{{$item->kode_transaksi}}</td>
                                <td>{{$item->tanggal}}</td>
                                <td>{{$item->namatype}}</td>
                                <td>{{$item->uom}}</td>
                                <td>{{$item->qty}}</td>
                                <td>{{$item->ppn}}</td>
                                <td>{{($item->ppn * $item->qty)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="6" style="text-align: right;">Total:</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css" />
<script>
    $(document).ready(function() {
        // Initialize DataTable with search functionality and responsive feature
        var table = $('#typebarang-table').DataTable({
            responsive: true,
            footer: true
        });

        // Add a search input field
        $('#typebarang-table thead tr').clone(true).appendTo('#typebarang-table thead');
        $('#typebarang-table thead tr:eq(1) th').each(function(index) {
            var title = $(this).text();
            if (index === 1) {
                $(this).html('<input type="text" class="form-control form-control-sm" placeholder="Search ' + title + '" />');
            } else {
                $(this).html('');
            }

            // Apply the search functionality
            $('input', this).on('keyup change', function() {
                if (table.column(index).search() !== this.value) {
                    table
                        .column(index)
                        .search(this.value)
                        .draw();
                    
                    // Recalculate the total after each search
                    var total = table.column(6, { search: 'applied' }).data().sum();
                    $('tfoot th:last-child').text(formatRupiah(total));
                }
            });
        });

        // Calculate the initial total
        var total = table.column(6).data().sum();
        $('tfoot th:last-child').text(formatRupiah(total));
    });

    // Extend jQuery DataTables with a sum() function
    $.fn.dataTable.Api.register('sum()', function() {
        return this.flatten().reduce(function(a, b) {
            if (typeof a === 'string') {
                a = a.replace(/[^\d.-]/g, '') * 1;
            }
            if (typeof b === 'string') {
                b = b.replace(/[^\d.-]/g, '') * 1;
            }

            return a + b;
        }, 0);
    });

    // Format number as Indonesian Rupiah
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
    }
</script>

@endpush
